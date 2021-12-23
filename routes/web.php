<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocietyController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\DisburseController;
use App\Http\Controllers\InterestController;
use App\Http\Controllers\InterestNonPayController;
use App\Http\Controllers\ExpenditureController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\MyReportController;
use App\Http\Controllers\MembersReportController;
use App\Http\Controllers\RegisteredAdminController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\SettingsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/society', SocietyController::class);

Route::resource('/deposit', DepositController::class);
Route::put('/deposit/delete/{id}', [DepositController::class, 'delete_update']);

Route::resource('/loan', LoanController::class);
Route::put('/loan/delete/{id}', [LoanController::class, 'delete_update']);

Route::resource('/loan_repayment', DisburseController::class);
Route::put('/loan_repayment/delete/{id}', [DisburseController::class, 'delete_update']);

Route::resource('/interest', InterestController::class);
Route::put('/interest/delete/{id}', [InterestController::class, 'delete_update']);

Route::resource('/interest_non_payment', InterestNonPayController::class);
Route::put('/interest_non_payment/delete/{id}', [InterestNonPayController::class, 'delete_update']);

Route::resource('/expenditure', ExpenditureController::class);
Route::put('/expenditure/delete/{id}', [ExpenditureController::class, 'delete_update']);

Route::resource('/admin_register', RegisteredAdminController::class);

Route::get('/dashboard', [DashboardController::class, 'dashboard']);


//Members
Route::get('/members', [RegisteredUserController::class, 'members']);
Route::get('/members/{id}', [RegisteredUserController::class, 'show']);
Route::get('/members/{id}/edit', [RegisteredUserController::class, 'edit']);
Route::put('/members/{id}', [RegisteredUserController::class, 'update']);
Route::put('/members/delete/{id}', [RegisteredUserController::class, 'delete_update']);

// Society Report Pages

Route::get('/reports', [ReportsController::class, 'reports']);

Route::get('/reports/show', [ReportsController::class, 'report_show']);

Route::get('/reports/collection_report', [ReportsController::class, 'collection_report']);

Route::get('/reports/deposit_report', [ReportsController::class, 'deposit_report']);

Route::get('/reports/interest_report', [ReportsController::class, 'interest_report']);

Route::get('/reports/loan_report', [ReportsController::class, 'loan_report']);

Route::get('/reports/late_fine_report', [ReportsController::class, 'late_fine_report']);

Route::get('/reports/interest_late_fine_report', [ReportsController::class, 'interest_late_fine_report']);

Route::get('/reports/loan_repayment_report', [ReportsController::class, 'loan_repayment_report']);

Route::get('/reports/expenditure_report', [ReportsController::class, 'expenditure_report']);

Route::get('/reports/cash_in_hand_report', [ReportsController::class, 'cash_in_hand_report']);


// Members Report Pages

Route::get('/members_reports', [MembersReportController::class, 'reports']);

Route::get('/members_reports/show', [MembersReportController::class, 'report_show']);

Route::get('/members_reports/deposit_report', [MembersReportController::class, 'deposit_report']);

Route::get('/members_reports/loan_report', [MembersReportController::class, 'loan_report']);

Route::get('/members_reports/late_fine_report', [MembersReportController::class, 'late_fine_report']);

Route::get('/members_reports/interest_report', [MembersReportController::class, 'interest_report']);

Route::get('/members_reports/loan_repayment_report', [MembersReportController::class, 'loan_repayment_report']);

// My Report Pages

Route::get('/my_reports', [MyReportController::class, 'reports']);

Route::get('/my_reports/show', [MyReportController::class, 'report_show']);

Route::get('/my_reports/deposit_report', [MyReportController::class, 'deposit_report']);

Route::get('/my_reports/loan_report', [MyReportController::class, 'loan_report']);

Route::get('/my_reports/late_fine_report', [MyReportController::class, 'late_fine_report']);

Route::get('/my_reports/interest_report', [MyReportController::class, 'interest_report']);

Route::get('/my_reports/loan_repayment_report', [MyReportController::class, 'loan_repayment_report']);


//Settings

Route::get('/settings', [SettingsController::class, 'index']);
Route::get('/settings/edit/{id}', [SettingsController::class, 'edit']);
Route::put('/settings/update/{id}', [SettingsController::class, 'update']);

Route::delete('/settings/delete/{id}', [SettingsController::class, 'destroy']);


require __DIR__.'/auth.php';