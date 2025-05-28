<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\TopUpProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with(['product', 'game'])
            ->latest()
            ->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    public function create($id)
    {
        $product = TopUpProduct::with('game')->findOrFail($id);
        return view('web.page.payment', compact('product'));
    }

    /**
     * Store a newly created order and redirect to a success page.
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
            $discountedPrice = isset($validated['discount']) 
                ? $validated['price'] * (1 - $validated['discount'] / 100) 
                : $validated['price'];

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

            // Redirect to order success page with order id
            return redirect()->route('order.success');

        } catch (QueryException $e) {
            Log::error('Order creation failed: ' . $e->getMessage());

            // Optionally redirect back with error message
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

    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['status' => 'required|string']);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->route('admin.orders.index')->with('success', 'Order updated successfully!');
    }

    public function markAsComplete($id)
    {
        $order = Order::findOrFail($id);

        if (strtolower($order->status) === 'pending') {
            $order->status = 'complete';
            $order->save();
        }

        return redirect()->route('admin.orders.show', $id)->with('success', 'Order marked as complete.');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully.');
    }
}
