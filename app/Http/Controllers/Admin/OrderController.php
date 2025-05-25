<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class OrderController extends Controller
{
    // Show all orders
    public function index()
    {
        $orders = Order::all();
        return view('admin.orders.index', compact('orders'));
    }

    // Store a new order
    public function store(Request $request){
    $validated = $request->validate([
        'email' => 'required|email',
        'game_uid' => 'required|string',
        'sender_number' => 'required|string',
        'transaction_id' => 'required|string|unique:orders,transaction_id',
        'payment_method' => 'required|string',
        'product_id' => 'required|exists:top_up_products,id',
        'price' => 'required|numeric',
        'game_id' => 'required|exists:games,id',
        'status' => 'sometimes|string',
        'top_up_product_id' => 'nullable|exists:top_up_products,id',
    ]);

    try {
        $order = Order::create([
            'email' => $validated['email'],
            'game_uid' => $validated['game_uid'],
            'sender_number' => $validated['sender_number'],
            'transaction_id' => $validated['transaction_id'],
            'payment_method' => $validated['payment_method'],
            'product_id' => $validated['product_id'],
            'game_id' => $validated['game_id'],
            'price' => $validated['price'],
            'status' => $validated['status'] ?? 'pending',
            'top_up_product_id' => $validated['top_up_product_id'] ?? $validated['product_id'], // <== default fallback
        ]);

        return response()->json([
            'message' => 'Order successfully placed',
            'order' => $order
        ], 201);
    } catch (QueryException $e) {
        Log::error('Order creation failed: ' . $e->getMessage());
        return response()->json([
            'message' => 'Failed to place order. Please try again.',
            'error' => $e->getMessage()
        ], 500);
    }
}


    // Update order status
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Order updated successfully!');
    }

    // Delete order
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted');
    }
}
