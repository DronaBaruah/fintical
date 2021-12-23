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
        <div class="flex flex-wrap md:-mt-48 -mt-16">
            <div class="w-full md:px-4 m-auto" style="max-width:1100px;">
                <div
                    class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-gray-100 border-0">
                    <div class="rounded-t bg-white mb-0 px-6 py-6">
                        <div class="text-center flex justify-between">
                            <h6 class="text-blueGray-700 text-xl font-bold">
                                Account Details
                            </h6>
                            <a href="/settings/edit/{{ $society->id }}">
                                <button
                                    class="bg-pink-500 text-white active:bg-pink-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                                    type="button">
                                    Edit Society
                                </button>
                            </a>
                        </div>
                    </div>

                    @if (session()->has('message'))
                    <div class="m-auto mt-4">
                        <p class="text-center font-semibold text-gray-100 bg-green-500 py-2 px-4 text-sm">
                            {{ session()->get('message') }}
                        </p>
                    </div>
                    @endif

                    <div class="flex-auto px-4 lg:px-10 py-10 pt-0">

                        <h6 class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase">
                            Society Information
                        </h6>
                        <div class="flex flex-wrap">
                            <div class="w-full lg:w-6/12 md:px-4">
                                <div class="relative w-full mb-3">
                                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                        htmlFor="grid-password">
                                        Society Name
                                    </label>
                                    <div
                                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                        {{ $society->name }}
                                    </div>

                                </div>
                            </div>
                            <div class="w-full lg:w-6/12 md:px-4">
                                <div class="relative w-full mb-3">
                                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                        htmlFor="grid-password">
                                        Society ID
                                    </label>
                                    <div
                                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                        {{ $society->society_id }}
                                    </div>

                                </div>
                            </div>
                            <div class="w-full lg:w-6/12 md:px-4">
                                <div class="relative w-full mb-3">
                                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                        htmlFor="grid-password">
                                        Society Type
                                    </label>
                                    <div
                                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                        {{ $society->society_type }}
                                    </div>

                                </div>
                            </div>
                            <div class="w-full lg:w-6/12 md:px-4">
                                <div class="relative w-full mb-3">
                                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                        htmlFor="grid-password">
                                        Share Value (₹)
                                    </label>
                                    <div
                                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                        (₹) {{ $society->share_value }}
                                    </div>

                                </div>
                            </div>
                            <div class="w-full lg:w-6/12 md:px-4">
                                <div class="relative w-full mb-3">
                                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                        htmlFor="grid-password">
                                        Lending Interest Rate (%)
                                    </label>
                                    <div
                                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                        {{ $society->lending_interest_rate }} (%)
                                    </div>

                                </div>
                            </div>
                            <div class="w-full lg:w-6/12 md:px-4">
                                <div class="relative w-full mb-3">
                                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                        htmlFor="grid-password">
                                        Society Duration
                                    </label>
                                    <div
                                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                        From {{ date('jS M Y', strtotime($society->society_start)) }} To
                                        {{ date('jS M Y', strtotime($society->society_end)) }}
                                    </div>

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
                                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                        htmlFor="grid-password">
                                        Address
                                    </label>
                                    <div
                                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                        {{ $society->address }}
                                    </div>

                                </div>
                            </div>
                            <div class="w-full lg:w-6/12 md:px-4">
                                <div class="relative w-full mb-3">
                                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                        htmlFor="grid-password">
                                        Phone No.
                                    </label>
                                    <div
                                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                        {{ $society->phone_no }}
                                    </div>

                                </div>
                            </div>
                        </div>
                        <hr class="mt-6 border-b-1 border-gray-300" />

                        <h6 class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase">
                            Society Admins
                        </h6>
                        <?php $number = 1 ?>
                        @foreach ($admins as $admin)
                        <div class="flex flex-wrap pb-2">
                            <div class="w-full lg:w-6/12 md:px-4">
                                <div class="relative w-full mb-3">
                                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                        htmlFor="grid-password">
                                        Admin Name (#{{ $number }})
                                    </label>
                                    <div
                                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                        {{ $admin->name }}
                                    </div>

                                </div>
                            </div>
                            <div class="w-full lg:w-6/12 md:px-4">
                                <div class="relative w-full mb-3">
                                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                        htmlFor="grid-password">
                                        Society Member (Yes/No)
                                    </label>
                                    <div
                                        class="border-0 px-3 py-3 capitalize text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                        {{ $admin->society_member }}
                                    </div>

                                </div>
                            </div>
                            <div class="w-full lg:w-6/12 md:px-4">
                                <div class="relative w-full mb-3">
                                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                        htmlFor="grid-password">
                                        Phone No.
                                    </label>
                                    <div
                                        class="border-0 px-3 py-3  text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                        {{ $admin->phone_no }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $number++ ?>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>


        <div class="w-full md:px-4 m-auto mt-5 mb-20" style="max-width:1100px;">
            <div class="md:flex md:flex-wrap w-full shadow-lg border-0 rounded bg-indigo-500 mb-0 md:px-6 md:py-5 py-2">
                <div class="w-full lg:w-6/12 md:px-4">
                    <div class="relative w-full">
                        <h6 class="text-white font-bold uppercase py-2 md:text-left text-center">
                            Delete Society Data
                        </h6>
                    </div>
                </div>
                <div class="w-full lg:w-6/12 md:px-4">
                    <div class="md:text-right text-center">
                        <button id="society_data" onclick="myFunction()"
                            class="bg-red-600 hover:bg-black leading-loose hover:text-white text-white font-bold uppercase text-sm px-4 py-1 rounded shadow hover:shadow-md outline-none mr-1 ease-linear transition-all duration-150"
                            type="button">
                            Click Here
                        </button>
                    </div>
                </div>
            </div>
            <div id="show_div" class="hidden bg-white rounded-b py-5">
                <form action="/settings/delete/{{ $society->society_id }}" method="POST"
                    onsubmit="return confirm('Do You Really Want To Delete?');">
                    @csrf
                    @method('delete')
                    <div class="md:flex md:flex-wrap w-full">
                        <div class="w-full lg:w-6/12 md:px-4">
                            <label class="inline-flex items-center mt-3 pl-5">
                                <input type="checkbox" class="form-checkbox h-5 w-5 text-red-600" name="records"
                                    value="records" required><span class="ml-2 text-gray-700">Delete All Transaction
                                    Records</span>
                            </label>
                        </div>
                        <div class="w-full lg:w-6/12 md:px-4">
                            <label class="inline-flex items-center mt-3 pl-5">
                                <input type="checkbox" class="form-checkbox h-5 w-5 text-red-600" name="members"
                                    value="members"><span class="ml-2 text-gray-700">Delete All Members (Except
                                    You)</span>
                            </label>
                        </div>
                        <div class="w-full lg:w-6/12 md:px-4">
                            <label class="inline-flex items-center mt-3 pl-5">
                                <input type="checkbox" class="form-checkbox h-5 w-5 text-red-600" name="all"
                                    value="all"><span class="ml-2 text-gray-700">Delete Society (All)</span>
                            </label>
                        </div>
                    </div>
                    <div class="md:px-8 px-4 pt-5">
                        <p class="font-bold">N.B.</p>
                        <p class="text-justify">1.<span class="text-red-600 font-bold"> Delete all transaction records
                            </span> will delete all the transaction performed.</p>
                        <p class="text-justify">2.<span class="text-red-600 font-bold"> Deleting all members (except
                                you) </span>
                            will also delete all the transaction records associated with it.</p>
                        <p class="text-justify">3.<span class="text-red-600 font-bold"> Deleting society </span> will
                            delete all the data and the society. <span class="text-red-600 font-bold">You won't be able
                                to login to this society again.</span> </p>
                    </div>
                    <div class="pt-5 m-auto w-full text-center">
                        <button type="submit"
                            class="bg-red-600 hover:bg-black hover:text-white text-white font-bold uppercase text-sm px-4 py-2 rounded shadow hover:shadow-md outline-none mr-1 ease-linear transition-all duration-150"
                            type="button">
                            Delete Permanently
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script type="text/javascript">
        function myFunction() {
            var x = document.getElementById("show_div");
            if (x.style.display === "block") {
                x.style.display = "none";
            } else {
                x.style.display = "block";
            }
        }
        </script>

        <!-- 
        <div class="w-full md:px-4 m-auto mt-5 mb-20" style="max-width:1100px;">
            <div class="md:flex md:flex-wrap w-full shadow-lg border-0 rounded bg-red-500 mb-0 md:px-6 md:py-5 py-2">
                <div class="w-full lg:w-6/12 md:px-4">
                    <div class="relative w-full">

                        <h6 class="text-white font-bold uppercase py-2 md:text-left text-center">
                            Delete Society
                        </h6>

                    </div>
                </div>
                <div class="w-full lg:w-6/12 md:px-4">
                    <div class="md:text-right text-center">
                        <form action="/settings/delete/{{ $society->society_id }}" method="POST"
                            onsubmit="return confirm('Do You Really Want To Delete Society?');">
                            @csrf
                            @method('delete')
                            <button type="submit"
                                class="bg-black hover:bg-red-600 hover:text-white text-white font-bold uppercase text-sm px-4 py-2 rounded shadow hover:shadow-md outline-none mr-1 ease-linear transition-all duration-150"
                                type="button">
                                Delete Permanently
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div> -->


    </div>
    @if (session()->has('access_denied'))
    <script>
    alert("{{ session()->get('access_denied') }}")
    </script>
    @endif
</body>

</html>