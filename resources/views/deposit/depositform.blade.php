<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Deposit</title>

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
                <div class="md:flex w-full">
                    <div class="w-full py-5 px-5 md:px-10">
                        <div class="text-center mb-5">
                            <h1 class="font-semibold text-xl text-gray-900">DEPOSIT FORM</h1>
                            <p>Enter deposit information</p>
                        </div>

                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />

                        <form method="POST" action="/deposit">
                            @csrf
                            <div>
                                <div class="md:flex -mx-3">
                                    <div class="w-full px-3 mb-5">
                                        <label for="" class="text-xs font-semibold px-1">Member Name</label>
                                        <div class="flex">
                                            <div
                                                class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                            </div>
                                            <div
                                                class="w-full -ml-10 pl-3  pr-3 py-2 rounded-lg border-2 font-semibold text-black border-gray-200 outline-none bg-gray-100">
                                                {{ $member->name }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full px-3 mb-5">
                                        <label for="" class="text-xs font-semibold px-1">Phone No.</label>
                                        <div class="flex">
                                            <div
                                                class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                            </div>
                                            <div
                                                class="w-full -ml-10 pl-3  pr-3 py-2 rounded-lg border-2 font-semibold text-black border-gray-200 outline-none bg-gray-100">
                                                {{ $member->phone_no }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="md:flex -mx-3">
                                    <div class="w-full px-3 mb-5">
                                        <label for="" class="text-xs font-semibold px-1">Total No. of Share</label>
                                        <div class="flex">
                                            <div
                                                class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                            </div>
                                            <div
                                                class="w-full -ml-10 pl-3  pr-3 py-2 rounded-lg border-2 font-semibold text-black border-gray-200 outline-none bg-gray-100">
                                                {{ $member->share_no }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full px-3 mb-5">
                                        <label for="" class="text-xs font-semibold px-1">Total Share Value (₹)</label>
                                        <div class="flex">
                                            <div
                                                class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                            </div>
                                            <div
                                                class="w-full -ml-10 pl-3  pr-3 py-2 rounded-lg border-2 font-semibold text-black border-gray-200 outline-none bg-gray-100">
                                                ₹ {{ $member->share_no * $society->share_value  }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h1 class="font-semibold text-xl text-center text-gray-900 py-3">Transaction</h1>
                                <div class="md:flex -mx-3">
                                    <div class="w-full px-3 mb-5">
                                        <label for="" class="text-xs font-semibold px-1">Month</label>
                                        <div class="flex">
                                            <div
                                                class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                                <i class="mdi mdi-calendar text-gray-400 text-lg"></i>
                                            </div>
                                            <select name="month" id=""
                                                class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500"
                                                required autofocus>
                                                <option value="">Select Month</option>
                                                <option value="January">January</option>
                                                <option value="February">February</option>
                                                <option value="March">March</option>
                                                <option value="April">April</option>
                                                <option value="May">May</option>
                                                <option value="June">June</option>
                                                <option value="July">July</option>
                                                <option value="August">August</option>
                                                <option value="September">September</option>
                                                <option value="October">October</option>
                                                <option value="November">November</option>
                                                <option value="December">December</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="w-full px-3 mb-5">
                                        <label for="" class="text-xs font-semibold px-1">Date</label>
                                        <div class="flex">
                                            <div
                                                class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                                <i class="mdi mdi-calendar text-gray-400 text-lg"></i>
                                            </div>
                                            <input type="date" name="date" id="date"
                                                class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500"
                                                required autofocus>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                var today = new Date();
                                var dd = today.getDate();
                                var mm = today.getMonth() + 1; //January is 0!
                                var yyyy = today.getFullYear();
                                if (dd < 10) {
                                    dd = '0' + dd
                                }
                                if (mm < 10) {
                                    mm = '0' + mm
                                }

                                today = yyyy + '-' + mm + '-' + dd;
                                document.getElementById("date").setAttribute("max", today);
                                document.getElementById("date").setAttribute("value", today);
                                </script>

                                <div class="md:flex -mx-3">
                                    <div class="w-full px-3 mb-5">
                                        <label for="" class="text-xs font-semibold px-1">Select Amount</label>
                                        <div class="flex">
                                            <div
                                                class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                                <i class="mdi mdi-currency-inr text-gray-400 text-lg"></i>
                                            </div>
                                            <select name="amount"
                                                class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500"
                                                required>
                                                <option value="">Select Amount</option>
                                                <option value="{{ $member->share_no * $society->share_value  }}">
                                                    (₹) {{ $member->share_no * $society->share_value  }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="w-full px-3 mb-5">
                                        <label for="" class="text-xs font-semibold px-1">Late Fine, if any</label>
                                        <div class="flex">
                                            <div
                                                class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                                <i class="mdi mdi-currency-inr text-gray-400 text-lg"></i>
                                            </div>
                                            <input type="number" name="fine" min="0" placeholder="0" value="0"
                                                class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500">
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
                                                class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500"></textarea>
                                        </div>
                                    </div>

                                </div>

                                <div class="flex -mx-3">
                                    <div class="w-full px-2 mb-3 mt-2">
                                        <button
                                            class="block w-full max-w-xs mx-auto bg-indigo-500 hover:bg-indigo-700 focus:bg-indigo-700 text-white rounded-lg px-2 py-3 font-semibold text-xl">DEPOSIT</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>