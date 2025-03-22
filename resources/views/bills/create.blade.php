@extends('layouts.base')

@section('content')
<div class="max-w-4xl p-6 mx-auto rounded-lg shadow-lg">
    <h2 class="mb-4 text-2xl font-bold">Order #{{ $order->id }}</h2>

    <!-- Order Details -->
    <div class="mb-4">
        <p><strong>Customer:</strong> {{ $order->customer->name }}</p>
        <p><strong>Date:</strong> {{ $order->date }}</p>
        <p><strong>Total Amount:</strong> ${{ number_format($order->total_amount, 2) }}</p>
        <p><strong>Status:</strong> {{ $order->status }}</p>
    </div>

    <!-- Ordered Products -->
    <h3 class="mb-2 text-xl font-semibold">Products</h3>
    @if ($order->details->count() > 0)
        <table class="w-full border border-collapse border-gray-300">
            <thead class="text-black">
                <tr class="bg-gray-200">
                    <th class="p-2 border border-gray-300">Product</th>
                    <th class="p-2 border border-gray-300">Quantity</th>
                    <th class="p-2 border border-gray-300">Price</th>
                    <th class="p-2 border border-gray-300">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->details as $detail)
                    <tr class="transition hover:bg-gray-100 hover:text-black">
                        <td class="p-2 border border-gray-300">{{ $detail->product->name }}</td>
                        <td class="p-2 text-center border border-gray-300">{{ $detail->quantity }}</td>
                        <td class="p-2 border border-gray-300">${{ number_format($detail->unit_price, 2) }}</td>
                        <td class="p-2 border border-gray-300">${{ number_format($detail->subtotal_price, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-gray-500">No products in this order.</p>
    @endif

    <!-- Action Buttons -->
    <form action="{{ route('bills.store',['order_id' => $order->id, 'customer_id' => $order->customer_id]) }}" method="POST" class="mt-8">
        @csrf
        <div class="flex flex-col">
            <label for="pay_method_id">Pay method</label>
            <select name="pay_method_id" id="pay_method_id" class="p-2 px-4 transition rounded-lg outline-white outline hover:bg-white hover:text-black">
                @foreach ($pay_methods as $method)
                    <option value="{{ $method->id }}" class="text-black">{{ $method->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex mt-4 space-x-4">
            <a href="{{ route('orders.index') }}" class="w-1/2 px-4 py-2 text-center text-white transition rounded hover:bg-white hover:text-black">Back</a>
            <button type="submit" class="w-1/2 px-4 py-2 text-center text-black transition bg-white rounded hover:text-white hover:bg-transparent">Pay order</button>
        </div>
    </form>
</div>
@endsection
