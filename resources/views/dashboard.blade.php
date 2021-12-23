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
    <title>Dashboard</title>
</head>

<body class="antialiased bg-gray-100">

    @include('layouts.sidebar')

    <div class="relative md:ml-64">
        <nav
            class="absolute top-0 left-0 w-full z-10 bg-transparent md:flex-row md:flex-nowrap md:justify-start flex items-center p-4">
            <div class="w-full mx-autp items-center flex justify-between md:flex-nowrap flex-wrap md:px-10 px-4">
                <div class="text-white text-base uppercase hidden lg:inline-block font-semibold">
                    {{ $society->name }}
                </div>

                <ul class="flex-col md:flex-row list-none items-center hidden md:flex">

                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <div
                            class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-pink-500">
                            <i class="fas fa-user"></i>
                        </div>
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="flex items-center pl-2 text-sm font-medium capitalize text-white hover:text-gray-100 hover:border-gray-100 focus:outline-none focus:text-gray-100 focus:border-gray-300 transition duration-150 ease-in-out">
                                    <div>{{ Auth::user()->name }}</div>

                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </ul>
            </div>
        </nav>

        <!-- Header -->
        <div class="relative bg-pink-600 md:pt-24 pt-6">
            <div class="px-4 md:px-10 mx-auto w-full">
                <div
                    class="text-white text-sm uppercase md:hidden lg:hidden xl:hidden 2xl:hidden font-semibold text-center pb-4">
                    {{ $society->name }}
                </div>
                <div>
                    <!-- Card stats -->
                    <div
                        class="md:grid md:grid-cols-2 xl:grid-cols-2 lg:grid-cols-2 2xl:grid-cols-4 gap-x-5 2xl:gap-x-3">
                        <div class="w-full pb-3 pt-2">
                            <div class="relative flex flex-col min-w-0 break-words bg-white rounded shadow-lg">
                                <div class="flex-auto pl-4 pr-4 pt-4 pb-3">
                                    <div class="flex flex-wrap">
                                        <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                            <h5 class="text-blueGray-400 uppercase font-bold text-xs">
                                                Today's Collection
                                            </h5>
                                            <span class="font-semibold text-xl text-blueGray-700">
                                                ₹ {{ $today_collection_amount }}
                                            </span>
                                        </div>
                                        <div class="relative w-auto pl-4 flex-initial">
                                            <div
                                                class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-red-500">
                                                <i class="fas fa-rupee-sign"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-sm mt-4">
                                        <a href="/reports/collection_report?report_type=date&date={{ $date }}"
                                            target="_blank">
                                            <button
                                                class="bg-indigo-600 hover:bg-indigo-800 text-white text-xs font-semibold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1"
                                                type="button">
                                                Show Records
                                            </button>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="w-full pb-3 pt-2">
                            <div class="relative flex flex-col min-w-0 break-words bg-white rounded shadow-lg">
                                <div class="flex-auto pl-4 pr-4 pt-4 pb-3">
                                    <div class="flex flex-wrap">
                                        <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                            <h5 class="uppercase font-bold text-xs">
                                                Loan Given Today
                                            </h5>
                                            <span class="font-semibold text-xl text-blueGray-700">
                                                ₹ {{ $today_loan_amount }}
                                            </span>
                                        </div>
                                        <div class="relative w-auto pl-4 flex-initial">
                                            <div
                                                class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-yellow-500">
                                                <i class="fas fa-chart-pie"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-400 mt-4">
                                        <a href="/reports/loan_report?report_type=date&date={{ $date }}"
                                            target="_blank">
                                            <button
                                                class="bg-indigo-600 hover:bg-indigo-800 text-white text-xs font-semibold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1"
                                                type="button">
                                                Show Records
                                            </button>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="w-full pb-3 pt-2">
                            <div class="relative flex flex-col min-w-0 break-words bg-white rounded shadow-lg">
                                <div class="flex-auto pl-4 pr-4 pt-4 pb-3">
                                    <div class="flex flex-wrap">
                                        <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                            <h5 class="uppercase font-bold text-xs">
                                                Cash in Hand Today
                                            </h5>
                                            <span class="font-semibold text-xl text-blueGray-700">
                                                ₹ {{ $today_cash_in_hand }}
                                            </span>
                                        </div>
                                        <div class="relative w-auto pl-4 flex-initial">
                                            <div
                                                class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-pink-500">
                                                <i class="fas fa-hand-holding-usd"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-sm text-blueGray-400 mt-4">
                                        <a href="/reports/cash_in_hand_report?report_type=date&date={{ $date }}"
                                            target="_blank">
                                            <button
                                                class="bg-indigo-600 hover:bg-indigo-800 text-white text-xs font-semibold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1"
                                                type="button">
                                                Show Records
                                            </button>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="w-full pb-3 pt-2">
                            <div class="relative flex flex-col min-w-0 break-words bg-white rounded shadow-lg">
                                <div class="flex-auto pl-4 pr-4 pt-4 pb-3">
                                    <div class="flex flex-wrap">
                                        <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                            <h5 class="uppercase font-bold text-xs">
                                                Today's Expenditure
                                            </h5>
                                            <span class="font-semibold text-xl text-blueGray-700">
                                                ₹ {{ $today_expenditure_amount }}
                                            </span>
                                        </div>
                                        <div class="relative w-auto pl-4 flex-initial">
                                            <div
                                                class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-blue-500">
                                                <i class="fas fa-coins"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-sm text-blueGray-400 mt-4">
                                        <a href="/reports/expenditure_report?report_type=date&date={{ $date }}"
                                            target="_blank">
                                            <button
                                                class="bg-indigo-600 hover:bg-indigo-800 text-white text-xs font-semibold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1"
                                                type="button">
                                                Show Records
                                            </button>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="relative bg-pink-600 pb-32">
            <div class="px-4 md:px-10 mx-auto w-full">
                <div>
                    <!-- Card stats -->
                    <div
                        class="md:grid md:grid-cols-2 xl:grid-cols-2 lg:grid-cols-2 2xl:grid-cols-4 gap-x-5 2xl:gap-x-3">
                        <div class="w-full pb-2 pt-3">
                            <div class="relative flex flex-col min-w-0 break-words bg-green-100 rounded shadow-lg">
                                <div class="flex-auto pl-4 pr-4 pt-4 pb-3">
                                    <div class="flex flex-wrap">
                                        <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                            <h5 class="uppercase font-bold text-xs">
                                                Total Collection
                                            </h5>
                                            <span class="font-semibold text-xl text-blueGray-700">
                                                ₹ {{ $total_collection_amount }}
                                            </span>
                                        </div>
                                        <div class="relative w-auto pl-4 flex-initial">
                                            <div
                                                class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-red-500">
                                                <i class="fas fa-rupee-sign"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-sm text-blueGray-400 mt-4">
                                        <a href="/reports/collection_report?report_type=all&date=none" target="_blank">
                                            <button
                                                class="bg-indigo-600 hover:bg-indigo-800 text-white text-xs font-semibold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1"
                                                type="button">
                                                Show Records
                                            </button>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="w-full pb-2 pt-3">
                            <div class="relative flex flex-col min-w-0 break-words bg-green-100 rounded shadow-lg">
                                <div class="flex-auto pl-4 pr-4 pt-4 pb-3">
                                    <div class="flex flex-wrap">
                                        <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                            <h5 class="uppercase font-bold text-xs">
                                                Total Loan Given
                                            </h5>
                                            <span class="font-semibold text-xl text-blueGray-700">
                                                ₹ {{ $total_loan_amount }}
                                            </span>
                                        </div>
                                        <div class="relative w-auto pl-4 flex-initial">
                                            <div
                                                class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-yellow-500">
                                                <i class="fas fa-chart-pie"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-sm text-blueGray-400 mt-4">
                                        <a href="/reports/loan_report?report_type=all&date=none" target="_blank">
                                            <button
                                                class="bg-indigo-600 hover:bg-indigo-800 text-white text-xs font-semibold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1"
                                                type="button">
                                                Show Records
                                            </button>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="w-full pb-2 pt-3">
                            <div class="relative flex flex-col min-w-0 break-words bg-green-100 rounded shadow-lg">
                                <div class="flex-auto pl-4 pr-4 pt-4 pb-3">
                                    <div class="flex flex-wrap">
                                        <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                            <h5 class="uppercase font-bold text-xs">
                                                Total Cash in Hand
                                            </h5>
                                            <span class="font-semibold text-xl text-blueGray-700">
                                                ₹ {{ $total_cash_in_hand }}
                                            </span>
                                        </div>
                                        <div class="relative w-auto pl-4 flex-initial">
                                            <div
                                                class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-pink-500">
                                                <i class="fas fa-hand-holding-usd"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-sm text-blueGray-400 mt-4">
                                        <a href="/reports/cash_in_hand_report?report_type=all&date=none"
                                            target="_blank">
                                            <button
                                                class="bg-indigo-600 hover:bg-indigo-800 text-white text-xs font-semibold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1"
                                                type="button">
                                                Show Records
                                            </button>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="w-full pb-2 pt-3">
                            <div class="relative flex flex-col min-w-0 break-words bg-green-100 rounded shadow-lg">
                                <div class="flex-auto pl-4 pr-4 pt-4 pb-3">
                                    <div class="flex flex-wrap">
                                        <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                            <h5 class="text-blueGray-400 uppercase font-bold text-xs">
                                                Total Expenditure
                                            </h5>
                                            <span class="font-semibold text-xl text-blueGray-700">
                                                ₹ {{ $total_expenditure_amount }}
                                            </span>
                                        </div>
                                        <div class="relative w-auto pl-4 flex-initial">
                                            <div
                                                class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-blue-500">
                                                <i class="fas fa-coins"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-sm text-blueGray-400 mt-4">
                                        <a href="/reports/expenditure_report?report_type=all&date=none" target="_blank">
                                            <button
                                                class="bg-indigo-600 hover:bg-indigo-800 text-white text-xs font-semibold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1"
                                                type="button">
                                                Show Records
                                            </button>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="px-4 md:px-10 mx-auto w-full -m-28">
            <div class="flex flex-wrap mt-4">
                <div class="w-full 2xl:w-8/12">
                    <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
                        <div class="rounded-t mb-0 px-4 py-3 border-0">
                            <div class="flex flex-wrap items-center">
                                <div class="relative w-full px-2 max-w-full flex-grow flex-1">
                                    <h3 class="font-semibold text-base">
                                        Deposit Collection
                                    </h3>
                                </div>
                                <div
                                    class="relative w-full px-2 max-w-full flex-grow flex-1 text-right hidden md:block">
                                    <button
                                        class="bg-indigo-500 text-white active:bg-indigo-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                        type="button">
                                        Last 20 Record
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="block w-full scrollbar" id="style-7">
                            <!-- Projects table -->
                            <table class="items-center w-full bg-transparent border-collapse">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-center">
                                            Member Name
                                        </th>
                                        <th
                                            class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-center">
                                            Date
                                        </th>
                                        <th
                                            class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-center">
                                            Month
                                        </th>
                                        <th
                                            class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-center">
                                            Share Value
                                        </th>
                                        <th
                                            class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-center">
                                            Fine
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($deposits as $deposit)
                                    <tr>
                                        <th
                                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-center capitalize">
                                            {{ $deposit->user->name }}
                                        </th>
                                        <td
                                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-center">
                                            {{ date('jS M Y', strtotime($deposit->date)) }}
                                        </td>
                                        <td
                                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-center">
                                            {{ $deposit->month }}
                                        </td>
                                        <td
                                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-center font-semibold">
                                            {{ $deposit->amount }}/-
                                        </td>
                                        <td
                                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-center font-semibold">
                                            {{ $deposit->fine }}/-
                                        </td>
                                    </tr>
                                    @endforeach

                                    @if($deposits->isEmpty())
                                    <tr>
                                        <th colspan=5
                                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-center">
                                            No Record Found ... !
                                        </th>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="w-full 2xl:w-4/12 2xl:pl-3">
                    <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
                        <div class="rounded-t mb-0 px-4 py-3 border-0">
                            <div class="flex flex-wrap items-center">
                                <div class="relative w-full px-2 max-w-full flex-grow flex-1">
                                    <h3 class="font-semibold text-base text-blueGray-700">
                                        Loan Details
                                    </h3>
                                </div>
                                <div
                                    class="relative w-full px-2 max-w-full flex-grow flex-1 text-right hidden md:block">
                                    <button
                                        class="bg-indigo-500 text-white active:bg-indigo-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                        type="button">
                                        Last 20 Record
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="block w-full scrollbar" id="style-7">
                            <!-- Projects table -->
                            <table class="items-center w-full bg-transparent border-collapse">
                                <thead class="thead-light">
                                    <tr>
                                        <th
                                            class="px-4 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-center">
                                            Member Name
                                        </th>
                                        <th
                                            class="px-4 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-center">
                                            Date
                                        </th>
                                        <th
                                            class="px-4 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-center">
                                            Loan Amount
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($loans as $loan)
                                    <tr>
                                        <th
                                            class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-center capitalize">
                                            <p class="capitalize">
                                                {{ $loan->user->name }}</p>
                                        </th>
                                        <td
                                            class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-center">
                                            {{ date('jS M Y', strtotime($loan->date)) }}
                                        </td>
                                        <td
                                            class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-center font-semibold">
                                            {{ $loan->amount }}/-
                                        </td>

                                    </tr>
                                    @endforeach

                                    @if($loans->isEmpty())
                                    <tr>
                                        <th colspan=3
                                            class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-center">
                                            No Record Found ... !
                                        </th>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @if (session()->has('access_denied'))
    <script>
    alert("{{ session()->get('access_denied') }}")
    </script>
    @endif
</body>

</html>