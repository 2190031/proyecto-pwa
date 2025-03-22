<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $isAdmin = Auth::user()->isadmin == 1 ? true : false;
        if ($isAdmin) {
            $orders = Order::with('customer')->get();
        } else {
            $orders = Order::where(['customer_id' => Auth::user()->id])->with('customer')->get();
        }
        return view('orders.index', compact('orders'));
    }

    public function show(int $id)
    {
        $order = Order::with(['customer', 'details.product'])->find($id);
        return view('orders.show', compact('order'));
    }

    public function create()
    {
        $cart = session()->get('cart', []);
        return view('orders.checkout', compact('cart'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'date' => 'required|date',
            'cart' => [
                'array',
                'required',

                ]
            ]);

        $cart = $request->cart;
        if (empty($cart)) {
            return redirect()->json(['error' => 'Your cart is empty.'], 500);
        }

        $order = Order::create([
            'customer_id' => Auth::id(),
            'date' => $request->date,
            'total_amount' => 0,
        ]);

        $totalAmount = 0;
        foreach ($cart as $productData) {
            $product = Product::find($productData['id']);
            $subtotal = $product->price * $productData['amount'];
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $productData['amount'],
                'unit_price' => $product->price,
                'subtotal_price' => $subtotal,
                'total_price' => $subtotal,
            ]);
            $totalAmount += $subtotal;
        }

        $order->update(['total_amount' => $totalAmount]);

        return response()->json(['success' => 'Order placed successfully.'], 201);
    }

    public function destroy(int $id)
    {
        Order::destroy($id);
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }

    public function cancel(int $id)
    {
        $order = Order::find($id);
        $order->status = "Cancelled";
        $order->save();
        return redirect()->route('orders.index')->with('success', 'Order cancelled successfully.');
    }

    public function reactivate(int $id)
    {
        $order = Order::find($id);
        $order->status = "Pending";
        $order->save();
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}
