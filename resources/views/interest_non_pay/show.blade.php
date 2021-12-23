<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Interest Non Payment</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

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
                            <h1 class="font-semibold text-lg text-gray-900">INTEREST NON PAYMENT</h1>
                        </div>

                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />


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
                                        ₹ {{ $member->share_no * $society->share_value  }}/-
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="md:flex -mx-3">
                            <div class="w-full px-3 mb-5">
                                <label for="" class="text-xs font-semibold px-1">Loan (₹)</label>
                                <div class="flex">
                                    <div
                                        class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                    </div>
                                    <div
                                        class="w-full -ml-10 pl-3  pr-3 py-2 rounded-lg border-2 text-red-500 font-bold border-gray-200 outline-none bg-gray-100">
                                        ₹ {{ $total_due_amount }}/-
                                    </div>
                                </div>
                            </div>
                            <div class="w-full px-3 mb-5">
                                <label for="" class="text-xs font-semibold px-1">Loan Interest Per Month
                                    (%)</label>
                                <div class="flex">
                                    <div
                                        class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                    </div>
                                    <div
                                        class="w-full -ml-10 pl-3  pr-3 py-2 rounded-lg border-2 font-semibold text-black border-gray-200 outline-none bg-gray-100">
                                        {{ $society->lending_interest_rate }} %
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h1 class="font-semibold text-xl text-center text-gray-900 py-3">Transaction Id: <span
                                class="text-red-700">
                                {{ $interestnonpay->interest_non_pay_id  }}</span></h1>

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
                                        {{ date('d-m-Y', strtotime($interestnonpay->date)) }}
                                    </div>
                                </div>
                            </div>
                            <div class="w-full px-3 mb-5">
                                <label for="" class="text-xs font-semibold px-1">Current Interest Non
                                    Payment</label>
                                <div class="flex">
                                    <div
                                        class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                        <i class="mdi mdi-currency-inr text-gray-400 text-lg"></i>
                                    </div>
                                    <div
                                        class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 font-semibold text-black border-gray-200 outline-none bg-gray-100">
                                        {{ $interestnonpay->interest_non_pay }}
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
                                        readonly> {{ $interestnonpay->remark }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="md:flex -mx-3">
                            <div class="w-full px-2 mb-3 md:mt-2 mt-5">
                                <form action="/interest_non_payment/delete/{{ $interestnonpay->id }}" method="POST"
                                    class="hide-submit"
                                    onsubmit="return confirm('Do you really want to delete record?');">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit"
                                        class="block w-full max-w-xs mx-auto bg-red-500 hover:bg-red-700  text-white rounded-lg px-2 py-3 font-semibold uppercase">DELETE
                                        Interest Non Payment</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="scrollbar bg-white my-6 mx-auto" style="max-width:1000px" id="style-7">
                <div class="flex items-center justify-center font-sans">
                    <div class="w-full">
                        <div class="bg-white shadow-md rounded">
                            <table class="min-w-max w-full table-auto">
                                <thead>
                                    <tr class="bg-gray-200 text-gray-800 uppercase text-xs leading-normal">
                                        <th class="py-2 px-4 text-center">#</th>
                                        <th class="py-2 px-4 text-center">Transaction ID</th>
                                        <th class="py-2 px-4 text-center">Member Name</th>
                                        <th class="py-2 px-4 text-center">Date</th>
                                        <th class="py-2 px-4 text-center">Interest Non Payment</th>
                                        <th class="py-2 px-4 text-center">Remark</th>
                                        <th class="py-2 px-4 text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-800 text-sm bg-white">
                                    <?php $number = 1; ?>
                                    @foreach ($Interestnonpays as $Interestnonpay)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100 text-sm">
                                        <td class="py-2 px-4 text-center whitespace-nowrap">
                                            <div class="flex items-center justify-center">
                                                <span>{{ $number }}</span>
                                            </div>
                                        </td>
                                        <td class="py-2 px-4 text-center whitespace-nowrap">
                                            <div class="flex items-center justify-center">
                                                <span>{{ $Interestnonpay->interest_non_pay_id }}</span>
                                            </div>
                                        </td>
                                        <td class="py-2 px-4 text-center whitespace-nowrap">
                                            <div class="flex items-center justify-center">
                                                <span>{{ $Interestnonpay->user->name }}</span>
                                            </div>
                                        </td>
                                        <td class="py-2 px-4 text-center">
                                            <div class="flex items-center justify-center">
                                                <span>{{ date('jS M Y', strtotime($Interestnonpay->date)) }}</span>
                                            </div>
                                        </td>

                                        <td class="py-2 px-4 text-center">
                                            <div class="flex items-center justify-center">
                                                <span>₹ {{ $Interestnonpay->interest_non_pay }}</span>
                                            </div>
                                        </td>

                                        <td class="py-2 px-4 text-center">
                                            <div class="flex items-center justify-center">
                                                <span>{{ $Interestnonpay->remark  }}</span>
                                            </div>
                                        </td>

                                        <td class="py-2 px-4 text-center">
                                            <div class="flex item-center justify-center">
                                                <div class="w-5 mr-5 transform hover:text-purple-500 hover:scale-110">
                                                    <a href="/interest_non_payment/{{ $Interestnonpay->id }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                    </a>
                                                </div>

                                                <style>
                                                form.hide-submit input[type="submit"] {
                                                    display: none;
                                                }
                                                </style>
                                                <div class="w-5 transform hover:text-purple-500 hover:scale-110">
                                                    <form
                                                        action="/interest_non_payment/delete/{{ $Interestnonpay->id }}"
                                                        method="POST" class="hide-submit"
                                                        onsubmit="return confirm('Do you really want to delete record?');">
                                                        @csrf
                                                        @method('PUT')
                                                        <label class="cursor-pointer">
                                                            <input type="submit" />
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </label>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $number++ ; ?>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>