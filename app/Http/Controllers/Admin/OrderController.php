<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\TopUpProduct;
use App\Models\Admin;
use App\Notifications\NewOrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Notification;

class OrderController extends Controller
{
    /**
     * Display a paginated listing of orders.
     */
    public function index(Request $request)
    {
        $orders = Order::with(['product', 'game'])
            ->latest()
            ->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the payment page for a given product.
     */
    public function create($id)
    {
        $product = TopUpProduct::with('game')->findOrFail($id);
        return view('web.page.payment', compact('product'));
    }

    /**
     * Store a newly created order, send notification, and redirect.
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
            'price'             => 'required|numeric',
            'discount'          => 'nullable|numeric|min:0|max:100',
            'status'            => 'nullable|string',
            'top_up_product_id' => 'nullable|exists:top_up_products,id',
        ]);

        try {
            // Calculate final price after discount
            $discountedPrice = isset($validated['discount'])
                ? $validated['price'] * (1 - $validated['discount'] / 100)
                : $validated['price'];

            // Create the order
            $order = Order::create([
                'email'             => $validated['email'],
                'game_uid'          => $validated['game_uid'],
                'sender_number'     => $validated['sender_number'],
                'transaction_id'    => $validated['transaction_id'],
                'payment_method'    => $validated['payment_method'],
                'product_id'        => $validated['product_id'],
                'game_id'           => $validated['game_id'],
                'price'             => $validated['price'],
                'discount'          => $validated['discount'] ?? 0,
                'final_price'       => $discountedPrice,
                'status'            => $validated['status'] ?? 'pending',
                'top_up_product_id' => $validated['top_up_product_id'] ?? $validated['product_id'],
            ]);

            // Send notification to all admins
            $admins = Admin::all();
            Notification::send($admins, new NewOrderNotification($order));

            // Redirect to order success page
            return redirect()->route('order.success');

        } catch (QueryException $e) {
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
     */
    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update the status of a specific order.
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
     */
    public function markAsComplete($id)
    {
        $order = Order::findOrFail($id);

        if (strtolower($order->status) === 'pending') {
            $order->status = 'complete';
            $order->save();
        }

        return redirect()
            ->route('admin.orders.show', $id)
            ->with('success', 'Order marked as complete.');
    }

    /**
     * Remove the specified order.
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
