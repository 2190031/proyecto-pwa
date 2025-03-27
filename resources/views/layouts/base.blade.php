<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Store | @yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <script src="{{ asset('app.js') }}" defer></script>

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif
</head>

<body class="bg-slate-950 text-white p-4 relative">
    <script>
        function openMenu() {
            document.querySelector("#menu").classList.toggle("hidden");
        }
    </script>
    @auth
        <div
            class="sticky flex gap-2 w-full p-3 mb-6 shadow-md rounded-2xl px-5 bg-slate-900 border-white/10 *:flex *:flex-row *:gap-2 *:hover:bg-white *:hover:text-slate-900 *:transition *:p-3 *:rounded-lg">
            <button onclick="openMenu()">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                    <path fill-rule="evenodd"
                        d="M2 4.75A.75.75 0 0 1 2.75 4h14.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 4.75ZM2 10a.75.75 0 0 1 .75-.75h14.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 10Zm0 5.25a.75.75 0 0 1 .75-.75h14.5a.75.75 0 0 1 0 1.5H2.75a.75.75 0 0 1-.75-.75Z"
                        clip-rule="evenodd" />
                </svg>
            </button>
            <a href="{{ route('products.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                    <path fill-rule="evenodd"
                        d="M9.293 2.293a1 1 0 0 1 1.414 0l7 7A1 1 0 0 1 17 11h-1v6a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-6H3a1 1 0 0 1-.707-1.707l7-7Z"
                        clip-rule="evenodd" />
                </svg>
                Home
            </a>
            <a class="" href="{{ route('cart') }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                    <path
                        d="M1 1.75A.75.75 0 0 1 1.75 1h1.628a1.75 1.75 0 0 1 1.734 1.51L5.18 3a65.25 65.25 0 0 1 13.36 1.412.75.75 0 0 1 .58.875 48.645 48.645 0 0 1-1.618 6.2.75.75 0 0 1-.712.513H6a2.503 2.503 0 0 0-2.292 1.5H17.25a.75.75 0 0 1 0 1.5H2.76a.75.75 0 0 1-.748-.807 4.002 4.002 0 0 1 2.716-3.486L3.626 2.716a.25.25 0 0 0-.248-.216H1.75A.75.75 0 0 1 1 1.75ZM6 17.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0ZM15.5 19a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z" />
                </svg>
                Cart
                <span id="cart-count"></span>
            </a>
            <form class="ms-auto" action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="flex flex-row gap-2 items-center" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                        <path fill-rule="evenodd"
                            d="M17 4.25A2.25 2.25 0 0 0 14.75 2h-5.5A2.25 2.25 0 0 0 7 4.25v2a.75.75 0 0 0 1.5 0v-2a.75.75 0 0 1 .75-.75h5.5a.75.75 0 0 1 .75.75v11.5a.75.75 0 0 1-.75.75h-5.5a.75.75 0 0 1-.75-.75v-2a.75.75 0 0 0-1.5 0v2A2.25 2.25 0 0 0 9.25 18h5.5A2.25 2.25 0 0 0 17 15.75V4.25Z"
                            clip-rule="evenodd" />
                        <path fill-rule="evenodd"
                            d="M14 10a.75.75 0 0 0-.75-.75H3.704l1.048-.943a.75.75 0 1 0-1.004-1.114l-2.5 2.25a.75.75 0 0 0 0 1.114l2.5 2.25a.75.75 0 1 0 1.004-1.114l-1.048-.943h9.546A.75.75 0 0 0 14 10Z"
                            clip-rule="evenodd" />
                    </svg>
                    Log Out</button>
            </form>

        </div>
        <nav id="menu"
            class="hidden absolute start-4 flex flex-col gap-2 w-max shadow-lg bg-slate-800 justify-around rounded-lg *:px-8 *:rounded-lg *:mx-2 *:p-1 *:hover:bg-white *:hover:text-slate-900 *:transition-all overflow-y-hidden">
            @if (auth()->user()->isadmin)
                <a class="m-2 mb-0" href="{{ route('users.index') }}">Users</a>
                <a href="{{ route('products.index') }}">Products</a>
                <a href="{{ route('categories.index') }}">Categories</a>
                <a href="{{ route('orders.index') }}">Orders</a>
                <a href="{{ route('bills.index') }}">Bills</a>
                <a class="mb-2 mt-0" href="{{ route('paymethods.index') }}">Pay Methods</a></div>
            @else
                <a class="m-2 mb-0" href="{{ route('products.index') }}">Products</a>
                <a href="{{ route('orders.index') }}">Orders</a>
                <a class="mb-2 mt-0" href="{{ route('bills.index') }}">Bills</a>
            @endif
        </nav>
    @else
        <div
            class="sticky flex items-center gap-2 w-full p-3 mb-6 shadow-md rounded-2xl px-5 bg-slate-900 border-white/10 *:flex *:flex-row *:gap-2 *:hover:bg-white *:hover:text-slate-900 *:transition *:p-3 *:rounded-lg">
            <a href="{{ route('loginForm') }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                    <path fill-rule="evenodd"
                        d="M9.293 2.293a1 1 0 0 1 1.414 0l7 7A1 1 0 0 1 17 11h-1v6a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-6H3a1 1 0 0 1-.707-1.707l7-7Z"
                        clip-rule="evenodd" />
                </svg>
                Home
            </a>
            <div class="transition-all ms-auto"><a href="{{ route('loginForm') }}">Login</a></div>
            <div class="transition-all"><a href="{{ route('signupForm') }}">Sign up</a></div>
        </div>

    @endauth
    <main class="md:p-[50px] lg:p-[100px] xl:max-w-2/3 mx-auto bg-slate-900 rounded-xl">
        @yield('content')
    </main>
</body>

</html>
