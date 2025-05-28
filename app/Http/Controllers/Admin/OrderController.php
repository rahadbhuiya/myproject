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
    /**
     * Display a listing of orders.
     */
    public function index()
    {
        $orders = Order::with(['product', 'game'])->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new order based on a product.
     */
    public function create($id)
    {
        $product = TopUpProduct::with('game')->findOrFail($id);
        return view('web.page.payment', compact('product'));
    }

    /**
     * Store a newly created order in storage.
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
            'status'            => 'sometimes|string',
            'top_up_product_id' => 'nullable|exists:top_up_products,id',
        ]);

        try {
            $order = Order::create([
                'email'             => $validated['email'],
                'game_uid'          => $validated['game_uid'],
                'sender_number'     => $validated['sender_number'],
                'transaction_id'    => $validated['transaction_id'],
                'payment_method'    => $validated['payment_method'],
                'product_id'        => $validated['product_id'],
                'game_id'           => $validated['game_id'],
                'price'             => $validated['price'],
                'status'            => $validated['status'] ?? 'pending',
                'top_up_product_id' => $validated['top_up_product_id'] ?? $validated['product_id'],
            ]);

            return response()->json([
                'message' => 'Order successfully placed',
                'order'   => $order,
            ], 201);

        } catch (QueryException $e) {
            Log::error('Order creation failed: ' . $e->getMessage());

            return response()->json([
                'message' => 'Failed to place order. Please try again.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified order details.
     */
    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update the specified order's status.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->route('admin.orders.index')->with('success', 'Order updated successfully!');
    }

    /**
     * Mark the specified order as complete.
     */
    public function markAsComplete($id)
    {
        $order = Order::findOrFail($id);

        if (strtolower($order->status) === 'pending') {
            $order->status = 'complete';
            $order->save();
        }

        return redirect()->route('admin.orders.show', $id)->with('success', 'Order marked as complete.');
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully.');
    }
}
