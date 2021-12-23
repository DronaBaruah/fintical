<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

    <style>
    @import url('https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.min.css');
    </style>

    <title>Member Reports</title>
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
                            <h1 class="font-semibold text-xl text-gray-900 uppercase">Member Reports</h1>
                        </div>

                        <div class="w-full">
                            <div class="overflow-x-auto bg-white shadow-md rounded">
                                <table class="min-w-max w-full table-auto">
                                    <tbody class="text-gray-600 text-sm font-light">
                                        <tr class="border-b border-gray-200 hover:bg-indigo-100">
                                            <td class="py-3 px-2 text-center whitespace-nowrap">
                                                <div class="flex items-center justify-center">
                                                    <span class="font-medium">1.</span>
                                                </div>
                                            </td>
                                            <td class="py-3 px-2 text-center">
                                                <form method="GET" action="/members_reports/deposit_report"
                                                    target="_blank">
                                                    @csrf
                                                    <?php 
                                                    $member_id = $_GET['member_id'];
                                                    $report_type = $_GET['report_type'];
                                                    $date = $_GET['date'];
                                                        
                                                    if($report_type == 'all')
                                                        {
                                                    ?>
                                                    <input type="hidden" name="member_id"
                                                        value="<?php echo $member_id ?>">
                                                    <input type="hidden" name="report_type"
                                                        value="<?php echo $report_type ?>">
                                                    <input type="hidden" name="date" value="none">
                                                    <?php
                                                        }
                                                        elseif($report_type == 'date')
                                                        {
                                                    ?>
                                                    <input type="hidden" name="member_id"
                                                        value="<?php echo $member_id ?>">
                                                    <input type="hidden" name="report_type"
                                                        value="<?php echo $report_type ?>">
                                                    <input type="hidden" name="date" value="<?php echo $date ?>">
                                                    <?php
                                                        }
                                                    
                                                    ?>
                                                    <button class="flex items-center justify-start">
                                                        <span class="font-medium">Deposit Report</span>
                                                    </button>
                                            </td>
                                            <td class="py-3 px-2 text-center">
                                                <div class="flex items-center justify-center">
                                                    <button
                                                        class="bg-blue-800 text-white px-4 py-2 font-semibold rounded">VIEW</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="border-b border-gray-200 hover:bg-indigo-100">
                                            <td class="py-3 px-2 text-center whitespace-nowrap">
                                                <div class="flex items-center justify-center">
                                                    <span class="font-medium">2.</span>
                                                </div>
                                            </td>
                                            <td class="py-3 px-2 text-center">
                                                <form method="GET" action="/members_reports/late_fine_report"
                                                    target="_blank">
                                                    @csrf
                                                    <?php 
                                                    $member_id = $_GET['member_id'];
                                                    $report_type = $_GET['report_type'];
                                                    $date = $_GET['date'];
                                                        
                                                    if($report_type == 'all')
                                                        {
                                                    ?>
                                                    <input type="hidden" name="member_id"
                                                        value="<?php echo $member_id ?>">
                                                    <input type="hidden" name="report_type"
                                                        value="<?php echo $report_type ?>">
                                                    <input type="hidden" name="date" value="none">
                                                    <?php
                                                        }
                                                        elseif($report_type == 'date')
                                                        {
                                                    ?>
                                                    <input type="hidden" name="member_id"
                                                        value="<?php echo $member_id ?>">
                                                    <input type="hidden" name="report_type"
                                                        value="<?php echo $report_type ?>">
                                                    <input type="hidden" name="date" value="<?php echo $date ?>">
                                                    <?php
                                                        }
                                                    
                                                    ?>
                                                    <button class="flex items-center justify-start">
                                                        <span class="font-medium">Deposit Late Fine Report</span>
                                                    </button>
                                            </td>
                                            <td class="py-3 px-2 text-center">
                                                <div class="flex items-center justify-center">
                                                    <button
                                                        class="bg-blue-800 text-white px-4 py-2 font-semibold rounded">VIEW</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="border-b border-gray-200 hover:bg-indigo-100">
                                            <td class="py-3 px-2 text-center whitespace-nowrap">
                                                <div class="flex items-center justify-center">
                                                    <span class="font-medium">3.</span>
                                                </div>
                                            </td>
                                            <td class="py-3 px-2 text-center">
                                                <form method="GET" action="/members_reports/loan_report"
                                                    target="_blank">
                                                    @csrf
                                                    <?php 
                                                    $member_id = $_GET['member_id'];
                                                    $report_type = $_GET['report_type'];
                                                    $date = $_GET['date'];
                                                        
                                                    if($report_type == 'all')
                                                        {
                                                    ?>
                                                    <input type="hidden" name="member_id"
                                                        value="<?php echo $member_id ?>">
                                                    <input type="hidden" name="report_type"
                                                        value="<?php echo $report_type ?>">
                                                    <input type="hidden" name="date" value="none">
                                                    <?php
                                                        }
                                                        elseif($report_type == 'date')
                                                        {
                                                    ?>
                                                    <input type="hidden" name="member_id"
                                                        value="<?php echo $member_id ?>">
                                                    <input type="hidden" name="report_type"
                                                        value="<?php echo $report_type ?>">
                                                    <input type="hidden" name="date" value="<?php echo $date ?>">
                                                    <?php
                                                        }
                                                    
                                                    ?>
                                                    <button class="flex items-center justify-start">
                                                        <span class="font-medium">Loan Issued Report</span>
                                                    </button>
                                            </td>
                                            <td class="py-3 px-2 text-center">
                                                <div class="flex items-center justify-center">
                                                    <button
                                                        class="bg-blue-800 text-white px-4 py-2 font-semibold rounded">VIEW</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="border-b border-gray-200 hover:bg-indigo-100">
                                            <td class="py-3 px-2 text-center whitespace-nowrap">
                                                <div class="flex items-center justify-center">
                                                    <span class="font-medium">4.</span>
                                                </div>
                                            </td>
                                            <td class="py-3 px-2 text-center">
                                                <form method="GET" action="/members_reports/interest_report"
                                                    target="_blank">
                                                    @csrf
                                                    <?php 
                                                    $member_id = $_GET['member_id'];
                                                    $report_type = $_GET['report_type'];
                                                    $date = $_GET['date'];
                                                        
                                                    if($report_type == 'all')
                                                        {
                                                    ?>
                                                    <input type="hidden" name="member_id"
                                                        value="<?php echo $member_id ?>">
                                                    <input type="hidden" name="report_type"
                                                        value="<?php echo $report_type ?>">
                                                    <input type="hidden" name="date" value="none">
                                                    <?php
                                                        }
                                                        elseif($report_type == 'date')
                                                        {
                                                    ?>
                                                    <input type="hidden" name="member_id"
                                                        value="<?php echo $member_id ?>">
                                                    <input type="hidden" name="report_type"
                                                        value="<?php echo $report_type ?>">
                                                    <input type="hidden" name="date" value="<?php echo $date ?>">
                                                    <?php
                                                        }
                                                    
                                                    ?>
                                                    <button class="flex items-center justify-start">
                                                        <span class="font-medium">Total Interest Collection
                                                            Report</span>
                                                    </button>
                                            </td>
                                            <td class="py-3 px-2 text-center">
                                                <div class="flex items-center justify-center">
                                                    <button
                                                        class="bg-blue-800 text-white px-4 py-2 font-semibold rounded">VIEW</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="border-b border-gray-200 hover:bg-indigo-100">
                                            <td class="py-3 px-2 text-center whitespace-nowrap">
                                                <div class="flex items-center justify-center">
                                                    <span class="font-medium">5.</span>
                                                </div>
                                            </td>
                                            <td class="py-3 px-2 text-center">
                                                <form method="GET" action="/members_reports/loan_repayment_report"
                                                    target="_blank">
                                                    @csrf
                                                    <?php 
                                                    $member_id = $_GET['member_id'];
                                                    $report_type = $_GET['report_type'];
                                                    $date = $_GET['date'];
                                                        
                                                    if($report_type == 'all')
                                                        {
                                                    ?>
                                                    <input type="hidden" name="member_id"
                                                        value="<?php echo $member_id ?>">
                                                    <input type="hidden" name="report_type"
                                                        value="<?php echo $report_type ?>">
                                                    <input type="hidden" name="date" value="none">
                                                    <?php
                                                        }
                                                        elseif($report_type == 'date')
                                                        {
                                                    ?>
                                                    <input type="hidden" name="member_id"
                                                        value="<?php echo $member_id ?>">
                                                    <input type="hidden" name="report_type"
                                                        value="<?php echo $report_type ?>">
                                                    <input type="hidden" name="date" value="<?php echo $date ?>">
                                                    <?php
                                                        }
                                                    
                                                    ?>
                                                    <button class="flex items-center justify-start">
                                                        <span class="font-medium">Loan Repayment
                                                            Report</span>
                                                    </button>
                                            </td>
                                            <td class="py-3 px-2 text-center">
                                                <div class="flex items-center justify-center">
                                                    <button
                                                        class="bg-blue-800 text-white px-4 py-2 font-semibold rounded">VIEW</button>
                                                    </form>
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
</body>

</html>