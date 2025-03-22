@extends('layouts.base')

@section('content')
    <form action="{{ route('login') }}" method="POST" class="flex flex-col items-center justify-center w-full">
        @csrf
        <h1 class="text-2xl font-black text-center">Log in</h1>
        <div class="flex flex-col justify-center mx-auto md:w-1/4">
            <div class="flex flex-col my-4">
                <label class="font-bold" for="email">Email:</label>
                <input required id="email" name="email" type="email" class="p-2 px-4 transition-all border-b-white border border-[#0a0a0a] focus:border-white focus:rounded-lg outline-0 ">
                @if($errors->has('email'))
                    <div class="text-red-400">{{ $errors->first('password') }}</div>
                @endif
            </div>
            <div class="flex flex-col my-4">
                <label class="font-bold" for="password">Password:</label>
                <input required id="password" name="password" type="password" class="p-2 px-4 transition-all border-b-white border border-[#0a0a0a] focus:border-white focus:rounded-lg outline-0 ">
                @if($errors->has('password'))
                    <div class="text-red-400">{{ $errors->first('password') }}</div>
                @endif
            </div>
            <button type="submit" class="bg-white hover:bg-transparent p-2 rounded-lg text-[#0a0a0a] transition-all hover:text-white font-black">Log in</button>
        </div>
        <small class="mt-4">Don't have an account? <a class="font-black hover:underline" href="{{ route('signup') }}">Register</a></small>
    </form>

@endsection
