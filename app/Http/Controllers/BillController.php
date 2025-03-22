<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Order;
use App\Models\PayMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{
    public function index()
    {
        $isAdmin = Auth::user()->isadmin == 1 ? true : false;
        if ($isAdmin) {
            $bills = Bill::all();
        } else {
            $bills = Bill::where('customer_id', Auth::id())->get();
        }
        return view('bills.index', compact('bills'));
    }

    public function show(int $id)
    {
        $bill = Bill::with(['customer', 'order.details.product'])->find($id);
        return view('bills.show', compact('bill'));
    }

    public function create($order_id) {
        $order = Order::find($order_id);
        $pay_methods = PayMethod::all();
        return view('bills.create', compact('order', 'pay_methods'));
    }

    public function store(Request $request, int $order_id, int $customer_id)
    {
        Bill::create([
            'order_id' => $order_id,
            'customer_id' => $customer_id,
            'bill_date' => date('Y-m-d H:i:s'),
            'payment_method_id' => $request->pay_method_id
        ]);

        $order = Order::find($order_id);
        $order->status = "Paid";
        $order->save();

        foreach ($order->details as $detail) {
            $product = $detail->product;
            if ($product->stock >= $detail->quantity) {
                $product->stock -= $detail->quantity;
                $product->save();
            } else {
                return redirect()->route('bills.index')->with('error', "Not enough stock for product: {$product->name}");
            }
        }


        return redirect()->route('bills.index')->with('success', 'Order billed successfully.');
    }

    public function destroy(int $id)
    {
        $bill = Bill::with('order')->find($id);
        $bill->order->status = "Pending";
        $bill->order->save();
        $bill->destroy($id);

        return redirect()->route('bills.index')->with('success', 'Order deleted successfully.');
    }

    public function cancel(int $id)
    {
        $bill = Bill::with('order')->find($id);
        $bill->status = "Cancelled";
        $bill->order->status = "Pending";
        $bill->order->save();
        $bill->save();

        return redirect()->route('bills.index')->with('success', 'Order cancelled successfully.');
    }

}
