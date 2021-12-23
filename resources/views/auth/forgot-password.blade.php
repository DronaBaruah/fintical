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

    <title>Forgot Password</title>
</head>

<body class="text-gray-700 antialiased" style="background-image: url(/assets/images/banner-bg-new.png);">
    @include('layouts.header')

    <div class="container mx-auto px-4 h-full md:pt-14 pt-10 pb-28">
        <div class="flex content-center items-center justify-center h-full">
            <div class="w-full lg:w-4/12 md:px-4 px-1">
                <div
                    class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg border-0 bg-gray-100">

                    <div class="mb-4 text-sm text-gray-600 px-4 pt-4 font-medium">
                        {{ __('Forgot your password?') }}

                    </div>
                    <div class="mb-4 text-sm text-gray-600 px-4 pb-4">
                        {{ __('No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                    </div>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4 px-5" :status="session('status')" />

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4 p-2" :errors="$errors" />

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <!-- Email Address -->
                        <div class="p-4">
                            <x-label for="email" :value="__('Email')" />

                            <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="old('email')" required autofocus />
                        </div>

                        <div class="flex items-center justify-end mt-4 p-4">
                            <x-button>
                                {{ __('Email Password Reset Link') }}
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