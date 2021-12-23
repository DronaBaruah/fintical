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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</head>

<body class="bg-gray-700">
    <div class="font-sans text-gray-900 antialiased">
        @include('layouts.sidebar')

        <div class="md:ml-64 min-h-screen pt-5 pb-10 px-1">
            @include('layouts.navbar')

            <div class="bg-gray-50 text-center text-gray-800 font-semibold text-xl w-full m-auto py-2 rounded-t border border-gray-300 md:mt-5"
                style="max-width:1000px;">
                {{ $society->name }}
            </div>
            @if (session()->has('message'))
            <div class="w-full m-auto bg-green-100 border border-green-400 text-gray-800 px-4 py-3 relative interestModal"
                id="interestModal" role="alert" style="max-width:1000px;">
                <div class="font-bold text-center">{{ session()->get('message') }}</div>
                <div class="text-center">{{ session()->get('transaction_id') }}
                    <span class="absolute top-0 bottom-0 right-0 md:px-4 pr-2 py-3">
                        <svg class="fill-current h-6 w-6 text-red-500 closeModal" role="button" id="closeModal"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <title>Close</title>
                            <path
                                d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                        </svg>
                </div>
            </div>
            <script type="text/javascript">
            $(document).ready(function() {
                $('.closeModal').on('click', function(e) {
                    $('#interestModal').addClass('hidden');
                });
            });
            </script>
            @endif
            <div class="w-full m-auto">
                <div class="bg-white text-center uppercase text-gray-800 font-semibold text-lg w-full m-auto py-2"
                    style="max-width:1000px;">
                    Society Expenditure
                </div>

                <div class="scrollbar bg-white mb-6 mx-auto rounded-b" style="max-width:1000px;" id="style-7">
                    <div class="w-full">
                        <div class="bg-white shadow-md rounded">
                            <table class="min-w-max w-full table-auto">
                                <thead>
                                    <tr class="bg-gray-200 text-gray-800 uppercase text-xs leading-normal">
                                        <th class="py-2 px-3 text-left">#</th>
                                        <th class="py-2 px-3 text-left">Transaction ID</th>
                                        <th class="py-2 px-3 text-left">Date</th>
                                        <th class="py-2 px-3 text-left">Amount</th>
                                        <th class="py-2 px-3 text-left">Remark</th>
                                        <th class="py-2 px-3 text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-800 text-sm bg-white">
                                    <?php $number = 1; ?>
                                    @foreach ($expenditures as $expenditure)
                                    <tr class="border-b border-gray-200 hover:bg-indigo-100 text-sm">
                                        <td width='50px' class="py-2 px-3 whitespace-nowrap">
                                            <div class="flex items-center justify-left">
                                                <span class="font-medium">{{ $number }}</span>
                                            </div>
                                        </td>
                                        <td width='200px' class="py-2 px-3">
                                            <div class="flex items-center justify-left">
                                                <span>{{ $expenditure->expenditure_id }}</span>
                                            </div>
                                        </td>
                                        <td width='150px' class="py-2 px-3">
                                            <div class="flex items-center justify-left">
                                                <span>{{ date('jS M Y', strtotime($expenditure->date)) }}</span>
                                            </div>
                                        </td>
                                        <td width='150px' class="py-2 px-3">
                                            <div class="flex items-center justify-left">
                                                <span>₹ {{ $expenditure->amount }}/-</span>
                                            </div>
                                        </td>
                                        <td width='250px' class="py-2 px-3">
                                            <div class="flex items-center justify-left">
                                                <div class="flex items-center justify-left">
                                                    <span>{{ $expenditure->remark }}</span>
                                                </div>

                                            </div>
                                        </td>

                                        <td class="py-2 px-4 text-center">
                                            <div class="flex item-center justify-center">
                                                <div class="w-5 mr-5 transform hover:text-purple-500 hover:scale-110">
                                                    <a href="/expenditure/{{ $expenditure->id }}">
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
                                                    <form action="/expenditure/delete/{{ $expenditure->id }}"
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
                                    <?php $number++; ?>
                                    @endforeach

                                    @if($expenditures->isEmpty())
                                    <tr class="text-red-700 bg-white font-bold text-sm leading-normal">
                                        <th class="py-2 px-3 text-center" colspan="6">No Record Found ....!</th>
                                    </tr>
                                    @else
                                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                        <th class="py-2 px-3 text-left" colspan="3">Total Expenditure</th>
                                        <th class="py-2 px-3 text-left" colspan="1">₹
                                            {{$total_expenditure_amount}}/-</th>
                                        <th class="py-2 px-3 text-left" colspan="2"></th>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>


        </div>
</body>

</html>