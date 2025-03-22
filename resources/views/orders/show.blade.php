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
    <div class="flex mt-4 space-x-4">
        <a href="{{ route('orders.index') }}" class="px-4 py-2 text-white transition rounded hover:bg-white hover:text-black">Back</a>
        @if ($order->status != 'Paid')
            <a href="{{ route('orders.edit', $order->id) }}" class="px-4 py-2 text-black transition bg-white rounded hover:text-white hover:bg-transparent">Edit</a>
            @if ($order->status != "Cancelled")
                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this order?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 text-white transition bg-red-500 rounded hover:bg-red-700">Cancel order</button>
                </form>
                <a href="{{ route('bills.create', $order->id) }}" class="px-4 py-2 text-black transition bg-white rounded ms-auto hover:text-white hover:bg-transparent">Close order</a>
            @else
                <form action="{{ route('orders.reactivate', $order->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to reactivate this order?');">
                    @csrf
                    <button type="submit" class="px-4 py-2 text-white transition bg-red-500 rounded hover:bg-red-700">Reactivate order</button>
                </form>
            @endif
        @endif
    </div>
</div>
@endsection
