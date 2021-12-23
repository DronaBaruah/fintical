<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Society;
use App\Models\Deposit;
use App\Models\Interest;
use App\Models\Loan;
use App\Models\Disburse;
use App\Models\Expenditure;
use App\Models\Interestnonpay;


use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
       if(Auth::user()->hasRole('admin'))
        {
            $usernew = User:: where('id', auth()->user()->id)->first();
            $society_id= $usernew->society_id;

            $date = date('Y-m-d');
          
            // today_collection

            $today_deposit_amount= Deposit::where([['society_id', $society_id], ['date', $date]])->sum('amount');
            $today_deposit_late_fine_amount= Deposit::where([['society_id', $society_id], ['date', $date]])->sum('fine');
            $today_interest_amount= Interest::where(([['society_id', $society_id], ['date', $date]]))->sum('total_interest');
            $today_disbursed_amount= Disburse::where(([['society_id', $society_id], ['date', $date]]))->sum('amount');

            $today_collection = $today_deposit_amount + $today_deposit_late_fine_amount + $today_interest_amount + $today_disbursed_amount;
        
            $today_collection_float = number_format((float)$today_collection, 2, '.', '');

            $today_collection_amount = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $today_collection_float);

            //today_Loan

            $today_loan= Loan::where([['society_id', $society_id], ['date', $date]])->sum('amount');

            $today_loan_float = number_format((float)$today_loan, 2, '.', '');

            $today_loan_amount = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $today_loan_float);
            

            //today_Expenditure
            
            $today_expenditure= Expenditure::where([['society_id', $society_id], ['date', $date]])->sum('amount');

            $today_expenditure_float = number_format((float)$today_expenditure, 2, '.', '');

            $today_expenditure_amount = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $today_expenditure_float);

            //today_cash in hand

            $to_cash_in_hand = $today_collection - ($today_loan + $today_expenditure);

            $to_cash_in_hand_float = number_format((float)$to_cash_in_hand, 2, '.', '');

            $today_cash_in_hand = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $to_cash_in_hand_float);

            //total Collection

            $total_deposit_amount= Deposit::where([['society_id', $society_id]])->sum('amount');
            $total_deposit_late_fine_amount= Deposit::where([['society_id', $society_id]])->sum('fine');
            $total_interest_amount= Interest::where(([['society_id', $society_id]]))->sum('total_interest');
            $total_disbursed_amount= Disburse::where(([['society_id', $society_id]]))->sum('amount');

            $total_collection = $total_deposit_amount + $total_deposit_late_fine_amount + $total_interest_amount + $total_disbursed_amount;
        
            $total_collection_float = number_format((float)$total_collection, 2, '.', '');

            $total_collection_amount = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $total_collection_float);

            //Total_Loan

            $total_loan= Loan::where([['society_id', $society_id]])->sum('amount');

            $total_loan_float = number_format((float)$total_loan, 2, '.', '');

            $total_loan_amount = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $total_loan_float);

            //total_Expenditure
            
            $total_expenditure= Expenditure::where([['society_id', $society_id]])->sum('amount');

            $total_expenditure_float = number_format((float)$total_expenditure, 2, '.', '');

            $total_expenditure_amount = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $total_expenditure_float);

            //total_cash in hand

            $t_cash_in_hand = $total_collection - ($total_loan + $total_expenditure);

            $t_cash_in_hand_float = number_format((float)$t_cash_in_hand, 2, '.', '');

            $total_cash_in_hand = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $t_cash_in_hand_float);

            return view('dashboard', compact('date', 'today_collection_amount', 'today_loan_amount','today_expenditure_amount', 'today_cash_in_hand', 'total_collection_amount', 'total_loan_amount', 'total_expenditure_amount', 'total_cash_in_hand'))
                ->with('society', Society::where('society_id', $society_id)->first())
                ->with('deposits', Deposit::where('society_id', $society_id)->orderBy('updated_at', 'DESC')->take(20)->get())
                ->with('loans', Loan::where('society_id', $society_id)->orderBy('updated_at', 'DESC')->take(20)->get());
        }
        elseif(Auth::user()->hasRole('member'))
        {
            $usernew = User:: where('id', auth()->user()->id)->first();
            $society_id= $usernew->society_id;

            // Total deposit
            $deposit_amount= Deposit::where([['society_id', $society_id], ['user_id', auth()->user()->id]])->sum('amount');

            $deposit_amount_float = number_format((float)$deposit_amount, 2, '.', '');

            $total_deposit_amount = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $deposit_amount_float);

            //Loan 
            $loan_amount= Loan::where([['society_id', $society_id], ['user_id', auth()->user()->id]])->sum('amount');

            //disbursed
            $disburse_amount= Disburse::where([['society_id', $society_id], ['user_id', auth()->user()->id]])->sum('amount');

            //Loan Due
            $loan_due = $loan_amount - $disburse_amount;

            $loan_due_float = number_format((float)$loan_due, 2, '.', '');

            $total_loan_due = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $loan_due_float);

            //interest Earn
            $current_interest= Interest::where([['society_id', $society_id]])->sum('interest_amount');
            
            $pre_interest= Interest::where([['society_id', $society_id]])->sum('previous_interest');

            $total_share= User::where([['society_id', $society_id], ['society_member', 'yes'], ['status', 'yes']])->sum('share_no');

            $interest_earn = ($current_interest + $pre_interest) / $total_share * auth()->user()->share_no;

            $interest_earn_float = number_format((float)$interest_earn, 2, '.', '');

            $total_interest_earn = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $interest_earn_float);


            //interest Due

            $interest_non_pay= Interestnonpay::where([['society_id', $society_id], ['user_id', auth()->user()->id]])->sum('interest_non_pay');
            $previous_interest= Interest::where([['society_id', $society_id], ['user_id', auth()->user()->id]])->sum('previous_interest');

            $member_interest_non_pay = $interest_non_pay - $previous_interest;

            $total_member_interest_non_pay = number_format((float)$member_interest_non_pay, 2, '.', '');
            
            $total_interest_non_pay = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $total_member_interest_non_pay);
            

            //Interest paid

            $interest= Interest::where([['society_id', $society_id], ['user_id', auth()->user()->id]])->sum('total_interest');
            
            $interest_float = number_format((float)$interest, 2, '.', '');
            
            $total_interest = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $interest_float);

            //Loan interest

            $society = Society::where('society_id', $society_id)->first();

            $loan_interest = $loan_due / 100 * $society->lending_interest_rate;

            $total_loan_interest_float = number_format((float)$loan_interest, 2, '.', '');
            
            $total_loan_interest = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $total_loan_interest_float);

            

            return view('member_dashboard', compact('total_deposit_amount', 'total_loan_due', 'total_interest_earn', 'total_interest', 'total_interest_non_pay', 'total_loan_interest'))
                ->with('society', Society::where('society_id', $society_id)->first())
                ->with('deposits', Deposit::where([['society_id', $society_id], ['user_id', auth()->user()->id]])->orderBy('updated_at', 'DESC')->take(20)->get())
                ->with('loans', Loan::where([['society_id', $society_id], ['user_id', auth()->user()->id]])->orderBy('updated_at', 'DESC')->take(20)->get());
        }
    }
}