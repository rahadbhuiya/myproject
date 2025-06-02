<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\TopUpProduct;
use App\Models\Admin;
use App\Models\Transaction;          // ← Add this import for creating billing records
use App\Notifications\NewOrderNotification;
use App\Services\Web3FormNotifier;    // ← Already present
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderCompleted;

class OrderController extends Controller
{
    /**
     * Display a paginated listing of orders.
     */
    public function index(Request $request)
    {
        // Eager load related models and paginate results
        $orders = Order::with(['product', 'game'])
            ->latest()
            ->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the payment page for a given product.
     *
     * @param int $id Product ID
     */
    public function create($id)
    {
        $product = TopUpProduct::with('game')->findOrFail($id);
        return view('web.page.payment', compact('product'));
    }

    /**
     * Store a newly created order, send notification, create a Transaction,
     * and redirect.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email'             => 'required|email',
            'game_uid'          => 'required|string',
            'sender_number'     => 'required|string',
            'transaction_id'    => 'required|string|unique:orders,transaction_id',
            'payment_method'    => 'required|string',
            'product_id'        => 'required|exists:top_up_products,id',
            'game_id'           => 'required|exists:games,id',
            'price'             => 'required|numeric|min:0',
            'discount'          => 'nullable|numeric|min:0|max:100',
            'status'            => 'nullable|string',
            'top_up_product_id' => 'nullable|exists:top_up_products,id',
        ]);

        try {
            // Calculate final price after applying discount (if any)
            $discount = $validated['discount'] ?? 0;
            $discountedPrice = $validated['price'] * (1 - $discount / 100);

            // Create the order in the database
            $order = Order::create([
                'user_id'           => auth()->id(),
                'email'             => $validated['email'],
                'game_uid'          => $validated['game_uid'],
                'sender_number'     => $validated['sender_number'],
                'transaction_id'    => $validated['transaction_id'],
                'payment_method'    => $validated['payment_method'],
                'product_id'        => $validated['product_id'],
                'game_id'           => $validated['game_id'],
                'price'             => $validated['price'],
                'discount'          => $discount,
                'final_price'       => $discountedPrice,
                'status'            => $validated['status'] ?? 'pending',
                'top_up_product_id' => $validated['top_up_product_id'] ?? $validated['product_id'],
            ]);

            // ————————————————
            // Insert into `transactions` table immediately after order creation:
            Transaction::create([
                'user_id'     => auth()->id(),
                'amount'      => $discountedPrice,
                'currency'    => 'BDT', // or use a request field if dynamic
                'status'      => 'completed',
                'description' => 'Order #' . $order->id . ' for Game UID: ' . $order->game_uid,
            ]);
            // ————————————————

            // Load relations for the order (if needed in notification)
            $order->load(['user', 'game', 'product']);

            // Notify all admins about the new order.
            // Since NewOrderNotification now includes both 'database' and 'mail' channels,
            // this single call will store a database notification and also send an email.
            $admins = Admin::all();
            Notification::send($admins, new NewOrderNotification($order));

            // ALSO: Send notification via Web3FormNotifier for external webhook/email
            Web3FormNotifier::sendOrderCreated($order);

            // Redirect to the order success page
            return redirect()->route('order.success');

        } catch (QueryException $e) {
            // Log error and show friendly message
            Log::error('Order creation failed: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->withErrors(['msg' => 'Failed to place order. Please try again.']);
        }
    }

    /**
     * Show the order success page.
     */
    public function success()
    {
        return view('frontend.order.success');
    }

    /**
     * Display a specific order.
     *
     * @param Order $order
     */
    public function show(Order $order)
    {
        // Send order viewed notification using the service
        // Web3FormNotifier::sendOrderViewed($order);

        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update the status of a specific order.
     *
     * @param Request $request
     * @param int $id Order ID
     */
    public function update(Request $request, $id)
    {
        $request->validate(['status' => 'required|string']);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()
            ->route('admin.orders.index')
            ->with('success', 'Order updated successfully!');
    }

    /**
     * Mark a pending order as complete.
     *
     * @param int $id Order ID
     */
    public function markAsComplete($id)
    {
        $order = Order::findOrFail($id);

        if (strtolower($order->status) === 'pending') {
            $order->status = 'completed';
            $order->save();

            // Send notification to user when order is completed
            if ($order->user) {
                $order->user->notify(new OrderCompleted($order));
            }

            // Send order completed notification using the service
            Web3FormNotifier::sendOrderCompleted($order);
        }

        return redirect()
            ->route('admin.orders.show', $id)
            ->with('success', 'Order marked as complete.');
    }

    /**
     * Remove the specified order.
     *
     * @param int $id Order ID
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()
            ->route('admin.orders.index')
            ->with('success', 'Order deleted successfully.');
    }
}
