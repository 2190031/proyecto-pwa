@extends('layouts.base')

@section('content')
    <div class="w-full">
        <div class="flex flex-row justify-between">
            <h1 class="text-2xl font-black">
                @if (auth()->user()->isadmin)
                    Orders
                @else
                    My orders
                @endif
            </h1>
        </div>
        <table class="w-full mt-3 table-auto">
            <thead>
                <tr class="*:text-start">
                    <th class="w-12">ID</th>
                    <th>Customer</th>
                    <th>Date</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if (count($orders) > 0)
                    @foreach ($orders as $order)
                        <tr class="transition hover:bg-white/5">
                            <td class="w-12">{{ $order->id }}</td>
                            <td>{{ $order->customer->name }}</td>
                            <td>{{ $order->date }}</td>
                            <td>${{ number_format($order->total_amount, 2) }}</td>
                            <td>{{ $order->status }}</td>
                            <td class="flex flex-col font-bold text-indigo-500 md:gap-4 md:flex-row">
                                <a href="{{ route('orders.show', $order->id) }}" class="">View</a>
                                <a href="{{ route('orders.edit', $order->id) }}" class="">Edit</a>
                                @if ($order->status != "Paid")

                                    @if ($order->status != "Cancelled")
                                        <form action="{{ route('orders.cancel', $order->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500" onclick="return confirm('Are you sure?')">Cancel</button>
                                        </form>
                                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    @else
                                        <form action="{{ route('orders.reactivate', $order->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="text-red-500" onclick="return confirm('Are you sure?')">Reactivate</button>
                                        </form>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="p-2 text-center">No orders made yet</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection
