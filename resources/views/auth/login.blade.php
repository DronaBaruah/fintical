<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link rel="stylesheet" type="text/css" href="/assets/css/font-awesome.css">

    <link rel="stylesheet" href="/assets/css/templatemo-softy-pinko1.css">


    <title>Login</title>
</head>

<body class="text-gray-700 antialiased" style="background-image: url(/assets/images/banner-bg-new.png);">
    @include('layouts.header')

    <div class="container mx-auto px-4 h-full md:pt-14 pt-10 pb-28">
        <div class="flex content-center items-center justify-center h-full">
            <div class="w-full lg:w-4/12 md:px-4 px-1">
                <div
                    class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg border-0 bg-indigo-200">
                    <div class="rounded-t py-6">
                        <div class="text-center mb-3">
                            <h6 class="text-gray-900 text-sm font-bold">
                                Sign in with Credentials
                            </h6>
                        </div>
                        <hr class="mt-6 border-b-1 border-gray-400" />
                    </div>

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-5 text-center" :errors="$errors" />

                    @if (session()->has('message'))
                    <div class="m-auto mb-2">
                        <p class="text-center text-red-600 text-sm">
                            {{ session()->get('message') }}
                        </p>
                    </div>
                    @endif
                    @if (session()->has('message_2'))
                    <div class="m-auto mb-2">
                        <p class="text-center text-black text-sm font-bold">
                            {{ session()->get('message_2') }}
                        </p>
                        <p class="text-center text-black text-sm font-bold">
                            {{ session()->get('message_3') }}
                        </p>
                    </div>
                    @endif

                    <div class="flex-auto px-4 lg:px-10 pb-3 pt-0">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="relative w-full mb-3">
                                <label class="block uppercase text-gray-600 text-xs font-bold mb-2"
                                    for="grid-password">User Name</label>
                                <input type="text" name="user_name"
                                    class="border-0 px-3 py-3 placeholder-gray-400 text-gray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                    placeholder="User Name" autocomplete="off" required />
                            </div>
                            <div class="relative w-full mb-3">
                                <label class="block uppercase text-gray-600 text-xs font-bold mb-2"
                                    for="grid-password">Password</label>
                                <input type="password" name="password"
                                    class="border-0 px-3 py-3 placeholder-gray-400 text-gray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                    placeholder="Password" autocomplete="off" required />
                            </div>
                            <div>
                                <label class="inline-flex items-center cursor-pointer"><input id="customCheckLogin"
                                        type="checkbox" name="remember"
                                        class="form-checkbox border-0 rounded text-gray-700 ml-1 w-5 h-5 ease-linear transition-all duration-150" /><span
                                        class="ml-2 text-sm font-semibold text-gray-600">Remember
                                        me</span></label>
                            </div>
                            <div class="text-center mt-6">
                                <button
                                    class="bg-gray-800 text-white active:bg-gray-600 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full ease-linear transition-all duration-150"
                                    type="submit">
                                    Sign In
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="text-center mb-3 pb-3 pt-2">
                        <h6 class="text-gray-600 text-sm">
                            <a href="/forgot-password">Forgot Password?</a>
                        </h6>
                    </div>
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

<!-- Bootstrap -->
<!-- <script src="/assets/js/popper.js"></script>
<script src="/assets/js/bootstrap.min.js"></script> -->

<!-- Plugins -->
<script src="/assets/js/scrollreveal.min.js"></script>
<!-- <script src="/assets/js/waypoints.min.js"></script>
<script src="/assets/js/jquery.counterup.min.js"></script>
<script src="/assets/js/imgfix.min.js"></script> -->

<!-- Global Init -->
<script src="/assets/js/custom.js"></script>



</html>