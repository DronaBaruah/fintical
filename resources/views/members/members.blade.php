<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Register</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style>
    @import url('https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.min.css');
    </style>

</head>

<body class="bg-gray-700">
    <div class="font-sans text-gray-900 antialiased">
        @include('layouts.sidebar')

        <div class="relative md:ml-64 md:pt-5 pb-10">
            @include('layouts.navbar')
            <div class="px-1 md:px-0">
                <div class="bg-gray-200 text-center font-semibold text-xl w-full m-auto py-2 rounded-t-md mt-5"
                    style="max-width:1000px;">
                    {{ $society_data->name }}

                    @if (session()->has('message'))
                    <div class="m-auto mt-4">
                        <p class="text-center font-semibold text-gray-100 bg-green-500 py-2 px-4 text-sm">
                            {{ session()->get('message') }}
                        </p>
                    </div>
                    @endif

                </div>
                <div class="bg-white p-1 md:text-right m-auto" style="max-width:1000px;">
                    <input type='text' id='txt_searchall' placeholder='Enter Search Text'
                        class="md:w-64 w-full text-sm text-gray-700 px-3 md:mx-2 py-1 rounded-md border-2 border-gray-400 outline-none focus:border-indigo-500">
                </div>
                <div class="scrollbar mx-auto w-full rounded-b-md" style="max-width:1000px;" id="style-7">
                    <div class="flex items-center justify-center font-sans">
                        <div class="w-full">
                            <div class="shadow-md rounded">
                                <table class="min-w-max w-full table-auto bg-white">
                                    <thead>
                                        <tr class="bg-indigo-800 text-white text-sm leading-normal">
                                            <th class="py-2 px-6 text-center">#</th>
                                            <th class="py-2 px-6 text-center">Member Name</th>
                                            @if (Auth::user()->hasRole('member'))
                                            <th class="py-2 px-6 text-center">Address</th>
                                            @endif
                                            @if(Auth::user()->hasRole('admin'))
                                            <th class="py-2 px-6 text-center">Loan (₹)</th>
                                            <th class="py-2 px-6 text-center">Interest (₹)</th>
                                            <th class="py-2 px-6 text-center">Phone No.</th>
                                            <th class="py-2 px-6 text-center">Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody class="text-gray-800 font-normal">
                                        <?php $number = 1; ?>
                                        @foreach($users as $user)
                                        <tr class="border-b border-gray-200 hover:bg-gray-100 text-sm">
                                            <td class="py-2 px-6 text-center whitespace-nowrap">
                                                <div class="flex items-center justify-center">
                                                    <span class="font-medium">{{ $number }}</span>
                                                </div>
                                            </td>
                                            <td class="py-2 px-6 text-center">
                                                <div class="flex items-center justify-center capitalize">
                                                    <span>{{ $user->name }}</span>
                                                </div>
                                            </td>
                                            @if (Auth::user()->hasRole('member'))
                                            <td class="py-2 px-6 text-center">
                                                <div class="flex items-center justify-center capitalize">
                                                    <span>{{ $user->address }}</span>
                                                </div>
                                            </td>
                                            @endif
                                            @if (Auth::user()->hasRole('admin'))
                                            <td class="py-2 px-6 text-center">
                                                <div class="flex items-center justify-center">
                                                    <span>{{ preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,",(number_format((float)$user->loan->sum('amount') - $user->disburse->sum('amount'), 2, '.', ''))) }}</span>
                                                </div>
                                            </td>
                                            <td class="py-2 px-6 text-center">
                                                <div class="flex items-center justify-center">
                                                    <span>{{ preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,",(number_format((float)$society_data->lending_interest_rate / 100 * ($user->loan->sum('amount') - $user->disburse->sum('amount')), 2, '.', ''))) }}</span>
                                                </div>
                                            </td>

                                            <td class="py-2 px-6 text-center">
                                                <div class="flex items-center justify-center">
                                                    <span>{{ $user->phone_no }}</span>
                                                </div>
                                            </td>

                                            <td class="py-2 px-6 text-center">
                                                <div class="flex item-center justify-center">
                                                    <div
                                                        class="w-5 mr-5 transform hover:text-purple-500 hover:scale-110">
                                                        <a href="/members/{{ $user->id }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <a href="/members/{{ $user->id }}/edit">
                                                        <div
                                                            class="w-4 transform hover:text-purple-500 hover:scale-110">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                            </svg>
                                                        </div>
                                                </div>
                                            </td>
                                            @endif
                                        </tr>
                                        <?php $number++ ?>
                                        @endforeach
                                        <!-- Display this <tr> when no record found while search -->
                                        <tr class="notfound border-b border-gray-200 hover:bg-gray-100 text-sm hidden">
                                            <td colspan='5' class="py-2 px-6 text-center">
                                                <div
                                                    class="flex items-center justify-center text-red-600 font-semibold">
                                                    <span>No record found</span>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
    $(document).ready(function() {

        // Search all columns
        $('#txt_searchall').keyup(function() {
            // Search Text
            var search = $(this).val();

            // Hide all table tbody rows
            $('table tbody tr').hide();

            // Count total search result
            var len = $('table tbody tr:not(.notfound) td:contains("' + search + '")').length;

            if (len > 0) {
                // Searching text in columns and show match row
                $('table tbody tr:not(.notfound) td:contains("' + search + '")').each(function() {
                    $(this).closest('tr').show();
                });
            } else {
                $('.notfound').show();
            }

        });



    });

    // Case-insensitive searching (Note - remove the below script for Case sensitive search )
    $.expr[":"].contains = $.expr.createPseudo(function(arg) {
        return function(elem) {
            return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
        };
    });
    </script>

</body>


</html>