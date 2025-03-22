@extends('layouts.base')

@section('content')
    <div class="w-full">
        <div class="flex flex-row justify-between">
            <h1 class="text-2xl font-black">Products</h1>
            @if (auth()->user()->isadmin)
                <a href="{{ route('products.create') }}"
                    class="bg-white hover:bg-transparent hover:text-white hover:outline outline-white transition cursor-pointer text-[#0a0a0a] rounded-lg flex flex-row gap-2 items-center p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>

                    <span class="font-black">New</span>
                </a>
            @endauth
    </div>
    <table class="w-full mt-3 table-auto">
        <thead>
            <tr class="*:text-start">
                <th></th>
                <th class="w-12">ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Stock</th>
                @if (auth()->user()->isadmin)
                    <th>Actions</th>
                @endif
            </tr>
        </thead>
        <tbody class="">
            @foreach ($products as $product)
                <tr class="transition hover:bg-white/5">
                    <td>
                        <div class="flex items-center justify-between m-1 rounded-lg outline w-fit">
                            <button data-button="remove-from-cart" data-id="{{ $product->id }}"
                                data-name="{{ $product->name }}" data-price="{{ $product->price }}"
                                class="cursor-pointer text-[#0a0a0a] hover:text-white bg-white rounded-s-lg hover:bg-transparent p-1 transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                                </svg>

                            </button>
                            <span data-id="{{ $product->id }}" class="w-10 text-center">0</span>
                            <button data-button="add-to-cart" data-id="{{ $product->id }}"
                                data-name="{{ $product->name }}" data-price="{{ $product->price }}"
                                class="cursor-pointer text-[#0a0a0a] hover:text-white bg-white rounded-e-lg hover:bg-transparent p-1 transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>

                            </button>

                        </div>
                    </td>
                    <td class="w-12">{{ $product->id }}</td>
                    <td><a
                            class="underline transition-all hover:underline-offset-2 hover:font-bold">{{ $product->name }}</a>
                    </td>
                    <td>{{ $product->description }}</td>
                    <td>${{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    @if (auth()->user()->isadmin)
                        <td class="flex flex-col font-bold text-indigo-500 md:gap-4 md:flex-row">
                            <a href="{{ route('products.edit', $product->id) }}" class="">Edit</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
