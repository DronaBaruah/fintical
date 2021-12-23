<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link rel="stylesheet" type="text/css" href="/assets/css/font-awesome.css">

    <link rel="stylesheet" href="/assets/css/templatemo-softy-pinko1.css">

    <title>Reset Password</title>
</head>

<body class="text-gray-700 antialiased" style="background-image: url(/assets/images/banner-bg-new.png);">
    @include('layouts.header')

    <div class="container mx-auto px-4 h-full md:pt-14 pt-10 pb-28">
        <div class="flex content-center items-center justify-center h-full">
            <div class="w-full lg:w-4/12 md:px-4 px-1">
                <div
                    class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg border-0 bg-gray-100">

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4 p-2" :errors="$errors" />

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <!-- Password Reset Token -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <!-- Email Address -->
                        <div class="px-3 pt-5">
                            <x-label for="email" :value="__('Email')" />

                            <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="old('email', $request->email)" required autofocus />
                        </div>

                        <!-- Password -->
                        <div class="mt-4 px-3">
                            <x-label for="password" :value="__('Password')" />

                            <x-input id="password" class="block mt-1 w-full" type="password" name="password" required />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4 px-3">
                            <x-label for="password_confirmation" :value="__('Confirm Password')" />

                            <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                name="password_confirmation" required />
                        </div>

                        <div class="flex items-center justify-end mt-4 p-2">
                            <x-button>
                                {{ __('Reset Password') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center m-auto" style="max-width:1100px">
        @include('layouts.footer')
    </div>
</body>
<!-- jQuery -->
<script src="/assets/js/jquery-2.1.0.min.js"></script>


<!-- Plugins -->
<script src="/assets/js/scrollreveal.min.js"></script>


<!-- Global Init -->
<script src="/assets/js/custom.js"></script>

</html>