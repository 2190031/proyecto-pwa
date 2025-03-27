@extends('layouts.base')

@section('content')
    <form action="{{ route('signup') }}" method="POST" class="flex flex-col items-center justify-center w-full">
        @csrf
        <h1 class="text-2xl font-black text-center">Sign up</h1>
        <div class="flex flex-col justify-center mx-auto md:w-1/4">
            <div class="flex flex-col my-4">
                <label class="font-bold" for="name">Name:</label>
                <input required id="name" name="name" type="text" class="p-2 px-4 transition-all border-b border-b-white border-white/10 focus:border focus:border-white focus:rounded-lg outline-0">
                @if($errors->has('name'))
                    <div class="text-red-400">{{ $errors->first('name') }}</div>
                @endif
            </div>
            <div class="flex flex-col my-4">
                <label class="font-bold" for="email">Email:</label>
                <input required id="email" name="email" type="email" class="p-2 px-4 transition-all border-b border-b-white border-white/10 focus:border focus:border-white focus:rounded-lg outline-0">
                @if($errors->has('email'))
                    <div class="text-red-400">{{ $errors->first('email') }}</div>
                @endif
            </div>
            <div class="flex flex-col my-4">
                <label class="font-bold" for="address">Address:</label>
                <textarea required id="address" name="address" type="text" class="p-2 px-4 transition-all border-b border-b-white border-white/10 focus:border focus:border-white focus:rounded-lg outline-0"></textarea>
                @if($errors->has('address'))
                    <div class="text-red-400">{{ $errors->first('address') }}</div>
                @endif
            </div>
            <div class="flex flex-col my-4">
                <label class="font-bold" for="password">Password:</label>
                <input required id="password" name="password" type="password" class="p-2 px-4 transition-all border-b border-b-white border-white/10 focus:border focus:border-white focus:rounded-lg outline-0">
                @if($errors->has('password'))
                    <div class="text-red-400">{{ $errors->first('password') }}</div>
                @endif
            </div>
            <div class="flex flex-col my-4">
                <label class="font-bold" for="password_confirmation">Repeat password:</label>
                <input required id="password_confirmation" name="password_confirmation" type="password" class="p-2 px-4 transition-all border-b border-b-white border-white/10 focus:border focus:border-white focus:rounded-lg outline-0">
                @if($errors->has('password_confirmation'))
                    <div class="text-red-400">{{ $errors->first('password_confirmation') }}</div>
                @endif
            </div>
            <button type="submit" class="bg-white hover:bg-transparent p-2 rounded-lg text-[#0a0a0a] transition-all hover:text-white font-black">Sign up</button>
        </div>
        <small class="mt-4">Already have an account? <a class="font-black hover:underline" href="{{ route('login') }}">Log in</a></small>
    </form>
@endsection
