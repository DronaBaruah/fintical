<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Reports</title>

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
                        <div class="text-center mb-5">
                            <h1 class="font-semibold text-xl md:text-xl text-gray-900 uppercase">Reports</h1>
                        </div>

                        <form method="GET" action="/reports/show">
                            @csrf
                            <div class="md:flex justify-center">
                                <div class="w-full md:px-3 mb-5">
                                    <label for="" class="text-xs font-semibold px-1">Select Report Type</label>
                                    <div class="flex">
                                        <div
                                            class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                            <i class="far fa-clipboard text-gray-400 text-lg"></i>
                                        </div>
                                        <select name="report_type" id="report_type"
                                            class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500"
                                            required>
                                            <option value="all">All Report</option>
                                            <option value="date">Date Wise Report</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="md:flex justify-center">
                                <div class="w-full md:px-3 mb-5 hidden" id="show_div">
                                    <label for="" class="text-xs font-semibold">Select Date</label>
                                    <div class="flex">
                                        <div
                                            class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                            <i class="mdi mdi-calendar text-gray-400 text-lg"></i>
                                        </div>
                                        <input type="date" name="date"
                                            class="w-full md:-ml-10 -ml-8 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500"
                                            require>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <div class="w-full m-auto text-center px-3 my-5">
                                    <button
                                        class="bg-indigo-500 hover:bg-indigo-700 focus:bg-indigo-700 text-white rounded-lg px-5 py-3 font-semibold uppercase">Show
                                        Report</button>
                                </div>
                            </div>
                        </form>

                        <script type="text/javascript">
                        $('document').ready(function() {
                            $("#report_type").change(function() {
                                var data = $(this).val();
                                if (data == "all") {
                                    $('#show_div').hide();
                                } else {
                                    $('#show_div').show();
                                }
                            });
                        });
                        </script>
                    </div>
                </div>
            </div>
        </div>

    </div>


</body>

</html>