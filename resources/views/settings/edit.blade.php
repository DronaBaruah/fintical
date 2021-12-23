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
    <title>Settings</title>
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
        <div class="relative bg-pink-600 md:pt-80 pt-6 pb-20 md:pb-0">
            <div class="px-4 md:px-10 mx-auto w-full">
                <div
                    class="text-white text-sm uppercase md:hidden lg:hidden xl:hidden 2xl:hidden font-semibold text-center pb-4">
                    {{ $society->name }}
                </div>
            </div>
        </div>
        <div class="flex flex-wrap md:-mt-48 -mt-16 mb-10">
            <div class="w-full md:px-4 m-auto" style="max-width:1100px;">
                <div
                    class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-gray-100 border-0">
                    <div class="rounded-t bg-white mb-0 px-6 py-6">
                        <div class="text-center flex justify-between">
                            <h6 class="text-blueGray-700 text-xl font-bold">
                                Account Details
                            </h6>

                        </div>
                    </div>

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="my-3 text-center" :errors="$errors" />

                    <div class="flex-auto px-4 lg:px-10 py-10 pt-0">

                        <h6 class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase">
                            Update Society Information
                        </h6>
                        <form action="/settings/update/{{ $society->id }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="flex flex-wrap">
                                <div class="w-full lg:w-6/12 md:px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                            Society ID
                                        </label>
                                        <div
                                            class="border-0 px-3 py-3 bg-gray-100 rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear font-bold">
                                            {{ $society->society_id }}
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full lg:w-6/12 md:px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                            Society Name
                                        </label>
                                        <input type="text" value=" {{ $society->name }}" name="name"
                                            class="border-0 px-3 py-3 placeholder-gray-300 text-gray-900 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full" />
                                    </div>
                                </div>

                                <div class="w-full lg:w-6/12 md:px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                            Society Type
                                        </label>

                                        <select
                                            class="border-0 px-3 py-3 placeholder-gray-300 text-gray-900 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full"
                                            id="society_type" name="society_type" placeholder="Society Type"
                                            value="Monthly" autocomplete="off" required readonly>
                                            <option value="{{ $society->society_type }}">{{ $society->society_type }}
                                            </option>
                                            @if( $society->society_type == "Monthly")
                                            <option value="Weekly">Weekly</option>
                                            @else
                                            <option value="Monthly">Monthly</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="w-full lg:w-6/12 md:px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                            One Share Value (₹)
                                        </label>
                                        <input
                                            class="border-0 px-3 py-3 placeholder-gray-300 text-gray-900 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full"
                                            id="share_value" type="number" name="share_value" placeholder="Share Value"
                                            value="{{ $society->share_value }}" min="0" autocomplete="off" required />
                                    </div>
                                </div>
                                <div class="w-full lg:w-6/12 md:px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                            Lending Interest Rate (%)
                                        </label>
                                        <input
                                            class="border-0 px-3 py-3 placeholder-gray-300 text-gray-900 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full"
                                            id="lending_interest_rate" type="number" name="lending_interest_rate"
                                            min="0" step=".01" placeholder="Lending Interest Rate" autocomplete="off"
                                            value="{{ $society->lending_interest_rate }}" required />
                                    </div>
                                </div>
                                <div class="w-full lg:w-6/12 md:px-4">

                                </div>
                                <div class="w-full lg:w-6/12 md:px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                            Society Starting Date
                                        </label>
                                        <input
                                            class="border-0 px-3 py-3 placeholder-gray-300 text-gray-900 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full"
                                            id="society_start" type="date" name="society_start"
                                            value="{{$society->society_start}}" placeholder="Society Start Date"
                                            autocomplete="off" required />
                                    </div>
                                </div>
                                <div class="w-full lg:w-6/12 md:px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                            Society Ending Date
                                        </label>
                                        <input
                                            class="border-0 px-3 py-3 placeholder-gray-300 text-gray-900 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full"
                                            id="society_end" type="date" name="society_end"
                                            value="{{$society->society_end}}" placeholder="Society Start Date"
                                            autocomplete="off" required />
                                    </div>
                                </div>
                            </div>

                            <hr class="mt-6 border-b-1 border-gray-300" />

                            <h6 class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase">
                                Contact Information
                            </h6>
                            <div class="flex flex-wrap">
                                <div class="w-full lg:w-12/12 md:px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                            Address
                                        </label>

                                        <input
                                            class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear"
                                            id="address" type="text" name="address" placeholder="Address"
                                            value="{{ $society->address }}" autocomplete="off" required />
                                    </div>
                                </div>
                                <div class="w-full lg:w-6/12 md:px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                            Phone No.
                                        </label>

                                        <input
                                            class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear"
                                            id="phone_no" type="number" name="phone_no" min="10"
                                            value="{{ $society->phone_no }}" placeholder="Phone Number" />
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 pt-10 text-center w-full ">
                                <button
                                    class="px-7 py-3 uppercase font-semibold text-white bg-blue-500 rounded-full hover:bg-blue-700 focus:outline-none focus:shadow-outline"
                                    type="submit">Update Register Society
                                </button>
                            </div>
                        </form>
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