@extends('layouts.base')

@section('content')
    <div class="w-full">
        <div class="flex flex-row justify-between">
            <h1 class="text-2xl font-black">
                @if (auth()->user()->isadmin)
                    Orders
                @else
                    My bills
                @endif
            </h1>
        </div>
        <table class="w-full mt-3 table-auto">
            <thead>
                <tr class="*:text-start *:px-3">
                    <th class="w-12">ID</th>
                    <th>Customer</th>
                    <th>Date</th>
                    <th>Total Amount</th>
                    <th>Order</th>
                    <th>Pay method</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if (count($bills) > 0)
                    @foreach ($bills as $bill)
                        <tr class="transition hover:bg-white/5 *:px-3">
                            <td class="w-12">{{ $bill->id }}</td>
                            <td>{{ $bill->customer->name }}</td>
                            <td>{{ $bill->bill_date }}</td>
                            <td>${{ number_format($bill->order->total_amount, 2) }}</td>
                            <td>{{ $bill->order_id }}</td>
                            <td>{{ $bill->paymentMethod->name }}</td>
                            <td>{{ $bill->status }}</td>
                            <td class="flex flex-col font-bold text-indigo-500 md:gap-4 md:flex-row">
                                <a href="{{ route('bills.show', $bill->id) }}" class="">View</a>
                                @if (auth()->user()->isadmin)
                                    <a href="{{ route('bills.edit', $bill->id) }}" class="">Edit</a>
                                    @if ($bill->status != "Cancelled")
                                        <form action="{{ route('bills.cancel', $bill->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500" onclick="return confirm('Are you sure?')">Cancel</button>
                                        </form>
                                    @endif
                                    <form action="{{ route('bills.destroy', $bill->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="p-2 text-center">No bills made yet</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection
