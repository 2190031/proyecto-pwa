<!-- resources/views/users/index.blade.php -->
@extends('layouts.base')

@section('content')
    <div class="w-full">
        <form action="{{ route('users.store') }}" method="post">
            <div class="flex flex-row justify-between">
                <h1 class="text-2xl font-black">New user:</h1>
                <div class="flex flex-row gap-2">
                    <a href="{{ route('users.index') }}"
                        class="bg-white hover:bg-transparent hover:text-white hover:outline outline-white transition cursor-pointer text-[#0a0a0a] rounded-lg flex flex-row gap-2 items-center p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
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
            @csrf
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 ">
                <div class="flex flex-col">
                    <label class="font-bold" for="name">Name:</label>
                    <input required id="name" name="name" type="text"
                        class="p-2 px-4 transition-all border-b-white border-b border-white/10 focus:border focus:border-white focus:rounded-lg outline-0">
                    @if ($errors->has('name'))
                        <div class="text-red-400">{{ $errors->first('name') }}</div>
                    @endif
                </div>
                <div class="flex flex-col">
                    <label class="font-bold" for="email">Email:</label>
                    <input required id="email" name="email" type="email"
                        class="p-2 px-4 transition-all border-b-white border-b border-white/10 focus:border focus:border-white focus:rounded-lg outline-0">
                    @if ($errors->has('email'))
                        <div class="text-red-400">{{ $errors->first('email') }}</div>
                    @endif
                </div>
                <div class="flex flex-col">
                    <label class="font-bold" for="address">Address:</label>
                    <textarea required maxlength="255" id="address" name="address"
                        class="p-2 px-4 transition-all border-b-white border-b border-white/10 focus:border focus:border-white focus:rounded-lg outline-0"></textarea>
                    @if ($errors->has('address'))
                        <div class="text-red-400">{{ $errors->first('address') }}</div>
                    @endif
                </div>
                <div class="flex flex-col">
                    <label class="font-bold" for="password">Role:</label>

                    <div class="flex items-center gap-x-3">
                        <input id="0" value="0" name="role" type="radio" checked
                            class="transition relative size-4 appearance-none rounded-full border border-gray-300 bg-white before:absolute before:inset-1 before:rounded-full before:bg-white not-checked:before:hidden checked:border-indigo-600 checked:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 forced-colors:appearance-auto forced-colors:before:hidden">
                        <label for="0" class="block text-sm/6 font-medium">Normal</label>
                    </div>
                    <div class="flex items-center gap-x-3">
                        <input id="1" value="1" name="role" type="radio"
                            class="transition relative size-4 appearance-none rounded-full border border-gray-300 bg-white before:absolute before:inset-1 before:rounded-full before:bg-white not-checked:before:hidden checked:border-indigo-600 checked:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 forced-colors:appearance-auto forced-colors:before:hidden">
                        <label for="1" class="block text-sm/6 font-medium">Admin</label>
                    </div>
                    @if ($errors->has('isadmin'))
                        <div class="text-red-400">{{ $errors->first('isadmin') }}</div>
                    @endif
                </div>
                <div class="flex flex-col">
                    <label class="font-bold" for="password">Password:</label>
                    <input id="password" name="password" type="password" required
                        class="p-2 px-4 transition-all border-b-white border-b border-white/10 focus:border focus:border-white focus:rounded-lg outline-0">
                    @if ($errors->has('password'))
                        <div class="text-red-400">{{ $errors->first('password') }}</div>
                    @endif
                </div>
                <div class="flex flex-col">
                    <label class="font-bold" for="password_confirmation">Repeat assword:</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                        class="p-2 px-4 transition-all border-b-white border-b border-white/10 focus:border focus:border-white focus:rounded-lg outline-0">
                    @if ($errors->has('password_confirmation'))
                        <div class="text-red-400">{{ $errors->first('password_confirmation') }}</div>
                    @endif
                </div>
            </div>
        </form>

    </div>
@endsection
