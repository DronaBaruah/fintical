<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Society Register</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <link rel="stylesheet" type="text/css" href="/assets/css/font-awesome.css">

    <link rel="stylesheet" href="/assets/css/templatemo-softy-pinko1.css">
</head>

<body style="background-image: url(/assets/images/banner-bg-new.png);">
    @include('layouts.header')
    <!-- Container -->
    <div class="container mx-auto">
        <div class="flex justify-center md:px-6 px-4 mb-12 md:mt-0 mt-5">
            <!-- Row -->
            <div class="w-full flex" style="max-width:1100px">
                <!-- Col -->
                <div class="w-full h-auto bg-gray-400 hidden lg:block lg:w-5/12 bg-cover rounded-l-lg"
                    style="background-image: url('https://1.bp.blogspot.com/-EpYLjOu4LwU/YRIrUoMELRI/AAAAAAAAHFU/k3L43z4ZsbUuOn4Z0QlMhrJjx3qHEWJRACLcBGAsYHQ/s0/photo12.jpg')">
                </div>
                <!-- Col -->
                <div class="w-full lg:w-7/12 bg-white p-5 rounded-lg lg:rounded-l-none">
                    <h3 class="pt-4 text-2xl font-semibold text-center">Register Society</h3>

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="my-3 text-center" :errors="$errors" />

                    <form method="POST" action="/society" enctype="multipart/form-data"
                        class="md:px-8 px-2 pt-6 pb-8 bg-white rounded">
                        @csrf
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="Name">
                                Society Name
                            </label>
                            <input
                                class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                id="name" type="text" name="name" placeholder="Society Name" autocomplete="off"
                                value="{{ old('name') }}" required />
                        </div>
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="address">
                                Address
                            </label>
                            <input
                                class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                id="address" type="text" name="address" placeholder="Address"
                                value="{{ old('address') }}" autocomplete="off" required />
                        </div>
                        <div class="mb-4 md:flex md:justify-between">
                            <div class="mb-4 md:mr-2 md:mb-0">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="phone_number">
                                    Phone Number
                                </label>
                                <input
                                    class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    id="phone_no" type="number" name="phone_no" min="10" value="{{ old('phone_no') }}"
                                    placeholder="Phone Number" />
                            </div>
                            <div class="mb-4 md:ml-2 md:mb-0">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="share_value">
                                    One Share Value (₹)
                                </label>
                                <input
                                    class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    id="share_value" type="number" name="share_value" value="{{ old('share_value') }}"
                                    placeholder="Share Value" min="0" autocomplete="off" required />
                            </div>
                        </div>
                        <script type="text/javascript">
                        $('document').ready(function() {
                            $("#society_type").change(function() {
                                var data = $(this).val();
                                if (data == "Monthly") {
                                    $('#monthly_div').show();
                                    $('#weekly_div').hide();
                                } else {
                                    $('#weekly_div').show();
                                    $('#monthly_div').hide();
                                }
                            });
                        });
                        </script>
                        <div class="mb-4 md:flex md:justify-between">
                            <div class="md:w-1/3 md:mr-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="society_type">
                                    Society Type
                                </label>
                                <select
                                    class="w-full pl-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    id="society_type" name="society_type" placeholder="Society Type" value="Monthly"
                                    autocomplete="off" required readonly>
                                    <option value="Monthly">Monthly</option>
                                    <option value="Weekly">Weekly</option>
                                </select>
                            </div>

                            <div class="md:ml-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="lending_interest_rate">
                                    <div id="monthly_div">Monthly Lending Interest Rate (%)</div>
                                    <div id="weekly_div" class="hidden">Weekly Lending Interest Rate (%)</div>
                                </label>
                                <input
                                    class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    id="lending_interest_rate" type="number" name="lending_interest_rate" min="0"
                                    step=".01" placeholder="Lending Interest Rate"
                                    value="{{ old('lending_interest_rate') }}" autocomplete="off" required />
                            </div>
                        </div>
                        <div class="mb-4 md:flex md:justify-between">
                            <div class="mb-4 md:mr-2 md:mb-0">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="share_value">
                                    Society Starting Date
                                </label>
                                <input
                                    class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    id="society_start" type="date" name="society_start"
                                    value="{{ old('society_start') }}" placeholder="Society Start Date"
                                    autocomplete="off" required />
                            </div>
                            <div class="md:ml-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="lending_interest_rate">
                                    Society Ending Date
                                </label>
                                <input
                                    class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    id="society_end" type="date" name="society_end" value="{{ old('society_end') }}"
                                    placeholder="Society End Date" autocomplete="off" required />
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
                        document.getElementById("society_start").setAttribute("value", today);
                        </script>

                        <script>
                        var today = new Date();
                        var dd = today.getDate();
                        var mm = today.getMonth() + 1; //January is 0!
                        var yyyy = today.getFullYear() + 1;
                        if (dd < 10) {
                            dd = '0' + dd
                        }
                        if (mm < 10) {
                            mm = '0' + mm
                        }

                        today = yyyy + '-' + mm + '-' + dd;

                        document.getElementById("society_end").setAttribute("value", today);
                        </script>

                        <div class="mb-3 pt-5 text-center">
                            <button
                                class="w-full px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700 focus:outline-none focus:shadow-outline"
                                type="submit">
                                Register Society
                            </button>
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