<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Expenditure</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <style>
    @import url('https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.min.css');
    </style>

</head>

<body class="bg-gray-700">
    <div class="font-sans text-gray-900 antialiased">
        @include('layouts.sidebar')


        <div class="md:ml-64 min-h-screen pt-5 pb-10 px-1">
            @include('layouts.navbar')
            <div class="bg-gray-100 text-gray-500 rounded-md shadow-xl w-full overflow-hidden m-auto md:mt-5"
                style="max-width:1000px">

                <div class="bg-gray-50 text-center text-gray-800 font-semibold text-xl w-full m-auto py-2 rounded-t-sm border border-gray-300"
                    style="max-width:1000px;">
                    {{ $society->name }}
                </div>
                <div class="md:flex w-full m-auto">

                    <div class="w-full py-5 px-5 md:px-10">
                        <div class="text-center mb-10">
                            <h1 class="font-semibold text-xl text-gray-900">EXPENDITURE</h1>
                        </div>
                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />

                        <div class="md:flex -mx-3">
                            <div class="w-full px-3 mb-5">
                                <label for="" class="text-xs font-semibold px-1">Total Expenditure Till Date
                                    (₹)</label>
                                <div class="flex">
                                    <div
                                        class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                    </div>
                                    <div
                                        class="w-full -ml-10 pl-3  pr-3 py-2 rounded-lg border-2 text-red-500 font-bold border-gray-200 outline-none bg-gray-100">
                                        ₹ {{ $total_expenditure_amount }}/-
                                    </div>
                                </div>
                            </div>
                            <div class="w-full px-3 mb-5">
                            </div>
                        </div>

                        <h1 class="font-semibold text-xl text-center text-gray-900 py-3">Transaction Id: <span
                                class="text-red-700">
                                {{ $expenditure->expenditure_id }}</span></h1>

                        @if (session()->has('message'))
                        <div class="m-auto mb-10 md:w-4/5">
                            <p class="w-full my-4 text-center font-bold text-white bg-red-500 rounded-md py-3">
                                {{ session()->get('message') }}
                            </p>
                        </div>
                        @endif

                        <div class="md:flex -mx-3">
                            <div class="w-full px-3 mb-5">
                                <label for="" class="text-xs font-semibold px-1">Date</label>
                                <div class="flex">
                                    <div
                                        class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                        <i class="mdi mdi-calendar text-gray-400 text-lg"></i>
                                    </div>
                                    <div
                                        class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 font-semibold text-black border-gray-200 outline-none bg-gray-100">
                                        {{ date('d-m-Y', strtotime($expenditure->date)) }}
                                    </div>
                                </div>
                            </div>
                            <div class="w-full px-3 mb-5">
                                <label for="" class="text-xs font-semibold px-1">Expenditure Amount (₹)</label>
                                <div class="flex">
                                    <div
                                        class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                        <i class="mdi mdi-currency-inr text-gray-400 text-lg"></i>
                                    </div>
                                    <div
                                        class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 font-semibold text-black border-gray-200 outline-none bg-gray-100">
                                        {{ $expenditure->amount }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="md:flex -mx-3">
                            <div class="w-full px-3 mb-5">
                                <label for="" class="text-xs font-semibold px-1">Remark</label>
                                <div class="flex">
                                    <div
                                        class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                        <i class="mdi mdi-application text-gray-400 text-lg"></i>
                                    </div>
                                    <textarea name="remark"
                                        class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 font-semibold text-black border-gray-200 outline-none bg-gray-100"
                                        readonly> {{ $expenditure->remark }}</textarea>
                                </div>
                            </div>
                        </div>
                        @if (Auth::user()->hasRole('admin'))
                        <div class="md:flex -mx-3">
                            <div class="w-full px-2 mb-3 md:mt-2 mt-5">
                                <form action="/expenditure/delete/{{ $expenditure->id }}" method="POST"
                                    class="hide-submit"
                                    onsubmit="return confirm('Do you really want to delete record?');">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit"
                                        class="block w-full max-w-xs mx-auto bg-red-500 hover:bg-red-700  text-white rounded-lg px-2 py-3 font-semibold uppercase">DELETE
                                        expenditure</button>
                                </form>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>