<!-- resources/views/products/index.blade.php -->
@extends('layouts.base')

@section('content')
    <div class="w-full">
        <form action="{{ route('products.update', $product->id) }}" method="post">
            <div class="flex flex-row justify-between">
                <h1 class="text-2xl font-black">Editting product {{ $product->id }}: {{ $product->name }}</h1>
                <div class="flex flex-row gap-2">
                    <a href="{{ route('products.index') }}"
                        class="bg-white hover:bg-transparent hover:text-white hover:outline outline-white transition cursor-pointer text-[#0a0a0a] rounded-lg flex flex-row gap-2 items-center p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                          </svg>

                        <span class="font-black">Discard</span>
                    </a>
                    <button type="submit"
                        class="bg-white hover:bg-transparent hover:text-white hover:outline outline-white transition cursor-pointer text-[#0a0a0a] rounded-lg flex flex-row gap-2 items-center p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                        <span class="font-black">Save</span>
                    </button>
                </div>
            </div>
            @method('PUT')
            @csrf
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 ">
                <div class="flex flex-col">
                    <label class="font-bold" for="name">Name:</label>
                    <input required id="name" name="name" type="text" value="{{ $product->name }}" class="p-2 px-4 transition-all border-b-white border-b border-white/10 focus:border focus:border-white focus:rounded-lg outline-0">
                </div>
                <div class="flex flex-col">
                    <label class="font-bold" for="description">Description:</label>
                    <textarea required maxlength="255" id="description" name="description" class="p-2 px-4 transition-all border-b-white border-b border-white/10 focus:border focus:border-white focus:rounded-lg outline-0">{{ $product->description }}</textarea>
                </div>
                <div class="flex flex-col">
                    <label class="font-bold" for="price">Price:</label>
                    <input required id="price" name="price" type="number" value="{{ $product->price }}" class="p-2 px-4 transition-all border-b-white border-b border-white/10 focus:border focus:border-white focus:rounded-lg outline-0">
                </div>
                <div class="flex flex-col">
                    <label class="font-bold" for="stock">Stock:</label>
                    <input required id="stock" name="stock" type="number" value="{{ $product->stock }}" class="p-2 px-4 transition-all border-b-white border-b border-white/10 focus:border focus:border-white focus:rounded-lg outline-0">
                </div>
                <div class="flex flex-col">
                    <label class="font-bold" for="category_id">Category:</label>
                    <select name="category_id" id="category_id" class="p-2 px-4 border rounded-lg">
                        @foreach ($categories as $category)
                            <option {{ $category->id == $product->category_id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>

    </div>
@endsection
