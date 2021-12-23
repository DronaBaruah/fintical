<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use App\Models\Society;
use App\Models\Deposit;
use App\Models\Interest;
use App\Models\Loan;
use App\Models\Disburse;
use App\Models\Expenditure;


use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function reports()
    {
        if(Auth::user()->hasRole('admin'))
        {
            $usernew = User:: where('id', auth()->user()->id)->first();
            $society_id= $usernew->society_id;
        
            return view('reports.reports')
                ->with('society', Society::where('society_id', $society_id)->first());
        }
        else
        {
            return redirect('/dashboard')
            ->with('access_denied', 'Access Denied');
        }
    }

    public function report_show()
    {
        if(Auth::user()->hasRole('admin'))
        {
            $usernew = User:: where('id', auth()->user()->id)->first();
            $society_id= $usernew->society_id;
        
            return view('reports.show')
                ->with('society', Society::where('society_id', $society_id)->first());
        }
        else
        {
            return redirect('/dashboard')
            ->with('access_denied', 'Access Denied');
        }
    }


    public function collection_report()
    {
        if(Auth::user()->hasRole('admin'))
        {
            $usernew = User:: where('id', auth()->user()->id)->first();
            $society_id= $usernew->society_id;

            $date = date('jS M Y');

            $report_type = $_GET['report_type'];

            if($report_type == 'all')
            {                  
            // collection

            $total_deposit_amount= Deposit::where([['society_id', $society_id], ['status', 'yes']])->sum('amount');
            $total_deposit_late_fine_amount= Deposit::where([['society_id', $society_id], ['status', 'yes']])->sum('fine');
            $total_pre_interest_amount= Interest::where(([['society_id', $society_id], ['status', 'yes']]))->sum('previous_interest');
            $total_interest_amount= Interest::where(([['society_id', $society_id], ['status', 'yes']]))->sum('interest_amount');
            $total_interest_late_fine_amount= Interest::where(([['society_id', $society_id], ['status', 'yes']]))->sum('lif_amount');
            $total_disbursed_amount= Disburse::where(([['society_id', $society_id], ['status', 'yes']]))->sum('amount');

            $total_collection = $total_deposit_amount + $total_deposit_late_fine_amount + $total_interest_amount + $total_interest_late_fine_amount + $total_pre_interest_amount + $total_disbursed_amount;
        
            $float = number_format((float)$total_collection, 2, '.', '');

            $total_collection_amount = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $float);
           
            return view('reports.collection_report', compact('total_collection_amount', 'total_deposit_amount', 'total_interest_late_fine_amount', 'total_pre_interest_amount', 'total_deposit_late_fine_amount', 'total_interest_amount', 'total_disbursed_amount', 'date'))
                ->with('society', Society::where('society_id', $society_id)->first())
                ->with('members', User::where([['society_id', $society_id], ['society_member', 'yes'], ['status', 'yes']])->get())
                ->with('admins', User::where([['society_id', $society_id], ['status', 'yes']])->wherehas('roles', function($q){
                    $q->where('name', 'admin');
                    })->get());
            }
            elseif($report_type == 'date')
            {
                $total_deposit_amount= Deposit::where([['society_id', $society_id], ['date', $_GET['date']], ['status', 'yes']])->sum('amount');
                $total_deposit_late_fine_amount= Deposit::where([['society_id', $society_id], ['date', $_GET['date']], ['status', 'yes']])->sum('fine');
                $total_pre_interest_amount= Interest::where(([['society_id', $society_id], ['date', $_GET['date']], ['status', 'yes']]))->sum('previous_interest');
                $total_interest_amount= Interest::where(([['society_id', $society_id], ['date', $_GET['date']], ['status', 'yes']]))->sum('interest_amount');
                $total_interest_late_fine_amount= Interest::where(([['society_id', $society_id], ['date', $_GET['date']], ['status', 'yes']]))->sum('lif_amount');
                $total_disbursed_amount= Disburse::where(([['society_id', $society_id], ['date', $_GET['date']], ['status', 'yes']]))->sum('amount');
    
                $total_collection = $total_deposit_amount + $total_deposit_late_fine_amount + $total_interest_amount + $total_interest_late_fine_amount + $total_pre_interest_amount + $total_disbursed_amount;
            
                $float = number_format((float)$total_collection, 2, '.', '');
    
                $total_collection_amount = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $float);
               
                return view('reports.collection_report', compact('total_collection_amount', 'total_deposit_amount', 'total_interest_late_fine_amount', 'total_pre_interest_amount', 'total_deposit_late_fine_amount', 'total_interest_amount', 'total_disbursed_amount', 'date'))
                    ->with('society', Society::where('society_id', $society_id)->first())
                    ->with('members', User::where([['society_id', $society_id], ['society_member', 'yes'], ['status', 'yes']])->get())
                    ->with('admins', User::where([['society_id', $society_id], ['status', 'yes']])->wherehas('roles', function($q){
                        $q->where('name', 'admin');
                        })->get());
            }
        }
        else
        {
            return redirect('/dashboard')
            ->with('access_denied', 'Access Denied');
        }
    }

    
    public function deposit_report()
    {
        if(Auth::user()->hasRole('admin'))
        {
            $usernew = User:: where('id', auth()->user()->id)->first();
            $society_id= $usernew->society_id;

            $date = date('jS M Y');

            $report_type = $_GET['report_type'];

            if($report_type == 'all')
            {                  
            $deposit_amount= Deposit::where([['society_id', $society_id], ['status', 'yes']])->sum('amount');

            $float = number_format((float)$deposit_amount, 2, '.', '');

            $total_deposit_amount = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $float);

            return view('reports.deposit_report', compact('total_deposit_amount', 'date'))
                ->with('society', Society::where('society_id', $society_id)->first())
                ->with('members', User::where([['society_id', $society_id], ['society_member', 'yes'], ['status', 'yes']])->get())
                ->with('admins', User::where([['society_id', $society_id], ['status', 'yes']])->wherehas('roles', function($q){
                    $q->where('name', 'admin');
                    })->get())
                ->with('deposits', Deposit::where([['society_id', $society_id], ['status', 'yes']])->orderBy('updated_at', 'DESC')->with('user')->get());
            }
            elseif($report_type == 'date')
            {
            $deposit_amount= Deposit::where([['society_id', $society_id], ['date', $_GET['date']], ['status', 'yes']])->sum('amount');

            $float = number_format((float)$deposit_amount, 2, '.', '');

            $total_deposit_amount = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $float);
            
            return view('reports.deposit_report', compact('total_deposit_amount', 'date'))
                ->with('society', Society::where('society_id', $society_id)->first())
                ->with('members', User::where([['society_id', $society_id], ['society_member', 'yes'], ['status', 'yes']])->get())
                ->with('admins', User::where([['society_id', $society_id], ['status', 'yes']])->wherehas('roles', function($q){
                    $q->where('name', 'admin');
                    })->get())
                ->with('deposits', Deposit::where([['society_id', $society_id], ['date', $_GET['date']], ['status', 'yes']])->orderBy('updated_at', 'DESC')->with('user')->get());
            }
        }
        else
        {
            return redirect('/dashboard')
            ->with('access_denied', 'Access Denied');
        }
    }

    public function loan_report()
    {
        if(Auth::user()->hasRole('admin'))
        {
            $usernew = User:: where('id', auth()->user()->id)->first();
            $society_id= $usernew->society_id;

            $report_type = $_GET['report_type'];

            $date = date('jS M Y');

            if($report_type == 'all')
            {                 
            $loan_amount= Loan::where([['society_id', $society_id], ['status', 'yes']])->sum('amount');

            $float = number_format((float)$loan_amount, 2, '.', '');

            $total_loan_amount = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $float);
            
            return view('reports.loan_report', compact('total_loan_amount', 'date'))
                ->with('society', Society::where('society_id', $society_id)->first())
                ->with('members', User::where([['society_id', $society_id], ['society_member', 'yes'], ['status', 'yes']])->get())
                ->with('admins', User::where([['society_id', $society_id], ['status', 'yes']])->wherehas('roles', function($q){
                    $q->where('name', 'admin');
                    })->get())
                ->with('loans', Loan::where([['society_id', $society_id], ['status', 'yes']])->orderBy('updated_at', 'DESC')->with('user')->get());
            }
            elseif($report_type == 'date')
            {
            $loan_amount= Loan::where([['society_id', $society_id], ['date', $_GET['date']], ['status', 'yes']])->sum('amount');

            $float = number_format((float)$loan_amount, 2, '.', '');

            $total_loan_amount = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $float);
            
            return view('reports.loan_report', compact('total_loan_amount', 'date'))
                ->with('society', Society::where('society_id', $society_id)->first())
                ->with('members', User::where([['society_id', $society_id], ['society_member', 'yes'], ['status', 'yes']])->get())
                ->with('admins', User::where([['society_id', $society_id], ['status', 'yes']])->wherehas('roles', function($q){
                    $q->where('name', 'admin');
                    })->get())
                ->with('loans', Loan::where([['society_id', $society_id], ['date', $_GET['date']], ['status', 'yes']])->orderBy('updated_at', 'DESC')->with('user')->get());
            }
        }
        else
        {
            return redirect('/dashboard')
            ->with('access_denied', 'Access Denied');
        }
    }

    public function interest_report()
    {
        if(Auth::user()->hasRole('admin'))
        {
            $usernew = User:: where('id', auth()->user()->id)->first();
            $society_id= $usernew->society_id;

            $report_type = $_GET['report_type'];

            $date = date('jS M Y');

            if($report_type == 'all')
            {           
            $interest_amount= Interest::where([['society_id', $society_id], ['status', 'yes']])->sum('total_interest');

            $float = number_format((float)$interest_amount, 2, '.', '');

            $total_interest_amount = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $float);
        
            return view('reports.interest_report', compact('total_interest_amount', 'date'))
                ->with('society', Society::where('society_id', $society_id)->first())
                ->with('members', User::where([['society_id', $society_id], ['society_member', 'yes'], ['status', 'yes']])->get())
                ->with('admins', User::where([['society_id', $society_id], ['status', 'yes']])->wherehas('roles', function($q){
                    $q->where('name', 'admin');
                    })->get())
                ->with('interests', Interest::where([['society_id', $society_id], ['status', 'yes']])->orderBy('updated_at', 'DESC')->with('user')->get());
            }
            elseif($report_type == 'date')
            {
            $interest_amount= Interest::where([['society_id', $society_id], ['date', $_GET['date']], ['status', 'yes']])->sum('total_interest');

            $float = number_format((float)$interest_amount, 2, '.', '');

            $total_interest_amount = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $float);
        
            return view('reports.interest_report', compact('total_interest_amount', 'date'))
                ->with('society', Society::where('society_id', $society_id)->first())
                ->with('members', User::where([['society_id', $society_id], ['society_member', 'yes'], ['status', 'yes']])->get())
                ->with('admins', User::where([['society_id', $society_id], ['status', 'yes']])->wherehas('roles', function($q){
                    $q->where('name', 'admin');
                    })->get())
                ->with('interests', Interest::where([['society_id', $society_id], ['date', $_GET['date']], ['status', 'yes']])->orderBy('updated_at', 'DESC')->with('user')->get());
            }
        }
        else
        {
            return redirect('/dashboard')
            ->with('access_denied', 'Access Denied');
        }
    }

    public function late_fine_report()
    {
        if(Auth::user()->hasRole('admin'))
        {
            $usernew = User:: where('id', auth()->user()->id)->first();
            $society_id= $usernew->society_id;

            $report_type = $_GET['report_type'];

            $date = date('jS M Y');

            if($report_type == 'all')
            {           
            $late_fine_amount= Deposit::where([['society_id', $society_id], ['status', 'yes']])->sum('fine');

            $float = number_format((float)$late_fine_amount, 2, '.', '');

            $total_late_fine_amount = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $float);
            
            return view('reports.late_fine_report', compact('total_late_fine_amount', 'date'))
                ->with('society', Society::where('society_id', $society_id)->first())
                ->with('members', User::where([['society_id', $society_id], ['society_member', 'yes'], ['status', 'yes']])->get())
                ->with('admins', User::where([['society_id', $society_id], ['status', 'yes']])->wherehas('roles', function($q){
                    $q->where('name', 'admin');
                    })->get())
                ->with('late_fines', Deposit::where([['society_id', $society_id], ['fine', '!=', '0.00'], ['status', 'yes']])->orderBy('updated_at', 'DESC')->with('user')->get());
            }
            elseif($report_type == 'date')
            {
            $late_fine_amount= Deposit::where([['society_id', $society_id], ['date', $_GET['date']], ['status', 'yes']])->sum('fine');

            $float = number_format((float)$late_fine_amount, 2, '.', '');

            $total_late_fine_amount = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $float);
            
            return view('reports.late_fine_report', compact('total_late_fine_amount', 'date'))
                ->with('society', Society::where('society_id', $society_id)->first())
                ->with('members', User::where([['society_id', $society_id], ['society_member', 'yes'], ['status', 'yes']])->get())
                ->with('admins', User::where([['society_id', $society_id], ['status', 'yes']])->wherehas('roles', function($q){
                    $q->where('name', 'admin');
                    })->get())
                ->with('late_fines', Deposit::where([['society_id', $society_id], ['date', $_GET['date']], ['fine', '!=', '0.00'], ['status', 'yes']])->orderBy('updated_at', 'DESC')->with('user')->get());
            }
        }
        else
        {
            return redirect('/dashboard')
            ->with('access_denied', 'Access Denied');
        }
    }

    public function interest_late_fine_report()
    {
        if(Auth::user()->hasRole('admin'))
        {
            $usernew = User:: where('id', auth()->user()->id)->first();
            $society_id= $usernew->society_id;

            $report_type = $_GET['report_type'];

            $date = date('jS M Y');

            if($report_type == 'all')
            {                  
            $interest_late_fine_amount= Interest::where([['society_id', $society_id], ['status', 'yes']])->sum('lif_amount');

            $float = number_format((float)$interest_late_fine_amount, 2, '.', '');

            $total_interest_late_fine_amount = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $float);

            return view('reports.interest_late_fine_report', compact('total_interest_late_fine_amount', 'date'))
                ->with('society', Society::where('society_id', $society_id)->first())
                ->with('members', User::where([['society_id', $society_id], ['society_member', 'yes'], ['status', 'yes']])->get())
                ->with('admins', User::where([['society_id', $society_id], ['status', 'yes']])->wherehas('roles', function($q){
                    $q->where('name', 'admin');
                    })->get())
                ->with('interest_late_fines', Interest::where([['society_id', $society_id], ['lif_amount', '!=', '0.00'], ['status', 'yes']])->orderBy('updated_at', 'DESC')->with('user')->get());
            }
            elseif($report_type == 'date')
            {
            $interest_late_fine_amount= Interest::where([['society_id', $society_id], ['date', $_GET['date']], ['status', 'yes']])->sum('lif_amount');

            $float = number_format((float)$interest_late_fine_amount, 2, '.', '');

            $total_interest_late_fine_amount = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $float);

            return view('reports.interest_late_fine_report', compact('total_interest_late_fine_amount', 'date'))
                ->with('society', Society::where('society_id', $society_id)->first())
                ->with('members', User::where([['society_id', $society_id], ['society_member', 'yes'], ['status', 'yes']])->get())
                ->with('admins', User::where([['society_id', $society_id], ['status', 'yes']])->wherehas('roles', function($q){
                    $q->where('name', 'admin');
                    })->get())
                ->with('interest_late_fines', Interest::where([['society_id', $society_id], ['date', $_GET['date']], ['lif_amount', '!=', '0.00'], ['status', 'yes']])->orderBy('updated_at', 'DESC')->with('user')->get());
            }
        }
        else
        {
            return redirect('/dashboard')
            ->with('access_denied', 'Access Denied');
        }
    }

    public function loan_repayment_report()
    {
        if(Auth::user()->hasRole('admin'))
        {
            $usernew = User:: where('id', auth()->user()->id)->first();
            $society_id= $usernew->society_id;

            $report_type = $_GET['report_type'];

            $date = date('jS M Y');

            if($report_type == 'all')
            {                  
            $disbursed_amount= Disburse::where([['society_id', $society_id], ['status', 'yes']])->sum('amount');

            $float = number_format((float)$disbursed_amount, 2, '.', '');

            $total_disbursed_amount = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $float);

            return view('reports.disbursed_report', compact('total_disbursed_amount', 'date'))
                ->with('society', Society::where('society_id', $society_id)->first())
                ->with('members', User::where([['society_id', $society_id], ['society_member', 'yes'], ['status', 'yes']])->get())
                ->with('admins', User::where([['society_id', $society_id], ['status', 'yes']])->wherehas('roles', function($q){
                    $q->where('name', 'admin');
                    })->get())
                ->with('disburses', Disburse::where([['society_id', $society_id], ['status', 'yes']])->orderBy('updated_at', 'DESC')->with('user')->get());
            }
            elseif($report_type == 'date')
            {
            $disbursed_amount= Disburse::where([['society_id', $society_id], ['date', $_GET['date']], ['status', 'yes']])->sum('amount');

            $float = number_format((float)$disbursed_amount, 2, '.', '');

            $total_disbursed_amount = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $float);

            return view('reports.disbursed_report', compact('total_disbursed_amount', 'date'))
                ->with('society', Society::where('society_id', $society_id)->first())
                ->with('members', User::where([['society_id', $society_id], ['society_member', 'yes'], ['status', 'yes']])->get())
                ->with('admins', User::where([['society_id', $society_id], ['status', 'yes']])->wherehas('roles', function($q){
                    $q->where('name', 'admin');
                    })->get())
                ->with('disburses', Disburse::where([['society_id', $society_id], ['date', $_GET['date']], ['status', 'yes']])->orderBy('updated_at', 'DESC')->with('user')->get());
            }
        }
        else
        {
            return redirect('/dashboard')
            ->with('access_denied', 'Access Denied');
        }
    }

    public function expenditure_report()
    {
        if(Auth::user()->hasRole('admin'))
        {
            $usernew = User:: where('id', auth()->user()->id)->first();
            $society_id= $usernew->society_id;

            $report_type = $_GET['report_type'];

            $date = date('jS M Y');

            if($report_type == 'all')
            {                  
            $expenditure_amount= Expenditure::where([['society_id', $society_id], ['status', 'yes']])->sum('amount');

            $float = number_format((float)$expenditure_amount, 2, '.', '');

            $total_expenditure_amount = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $float);

            return view('reports.expenditure_report', compact('total_expenditure_amount', 'date'))
                ->with('society', Society::where('society_id', $society_id)->first())
                ->with('members', User::where([['society_id', $society_id], ['society_member', 'yes'], ['status', 'yes']])->get())
                ->with('admins', User::where([['society_id', $society_id], ['status', 'yes']])->wherehas('roles', function($q){
                    $q->where('name', 'admin');
                    })->get())
                ->with('expenditures', Expenditure::where([['society_id', $society_id], ['status', 'yes']])->orderBy('updated_at', 'DESC')->with('user')->get());
            }
            elseif($report_type == 'date')
            {
            $expenditure_amount= Expenditure::where([['society_id', $society_id], ['date', $_GET['date']], ['status', 'yes']])->sum('amount');

            $float = number_format((float)$expenditure_amount, 2, '.', '');

            $total_expenditure_amount = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $float);

            return view('reports.expenditure_report', compact('total_expenditure_amount', 'date'))
                ->with('society', Society::where('society_id', $society_id)->first())
                ->with('members', User::where([['society_id', $society_id], ['society_member', 'yes'], ['status', 'yes']])->get())
                ->with('admins', User::where([['society_id', $society_id], ['status', 'yes']])->wherehas('roles', function($q){
                    $q->where('name', 'admin');
                    })->get())
                ->with('expenditures', Expenditure::where([['society_id', $society_id], ['date', $_GET['date']], ['status', 'yes']])->orderBy('updated_at', 'DESC')->with('user')->get());
            }
        }
        else
        {
            return redirect('/dashboard')
            ->with('access_denied', 'Access Denied');
        }
    }

    public function cash_in_hand_report()
    {
        if(Auth::user()->hasRole('admin'))
        {
            $usernew = User:: where('id', auth()->user()->id)->first();
            $society_id= $usernew->society_id;

            $report_type = $_GET['report_type'];

            $date = date('jS M Y');

            if($report_type == 'all')
            {           
            $total_deposit_amount= Deposit::where([['society_id', $society_id], ['status', 'yes']])->sum('amount');
            $total_late_fine_amount= Deposit::where([['society_id', $society_id], ['status', 'yes']])->sum('fine');
            $total_interest_amount= Interest::where([['society_id', $society_id], ['status', 'yes']])->sum('interest_amount');
            $total_pre_interest_amount= Interest::where([['society_id', $society_id], ['status', 'yes']])->sum('previous_interest');
            $total_interest_late_fine_amount= Interest::where([['society_id', $society_id], ['status', 'yes']])->sum('lif_amount');
            $total_disbursed_amount= Disburse::where([['society_id', $society_id], ['status', 'yes']])->sum('amount');

            $total_loan_amount= Loan::where([['society_id', $society_id], ['status', 'yes']])->sum('amount');
            $total_expenditure_amount= Expenditure::where([['society_id', $society_id], ['status', 'yes']])->sum('amount');

            $cash_in_hand = ($total_deposit_amount + $total_late_fine_amount + $total_interest_amount + $total_pre_interest_amount + $total_interest_late_fine_amount + $total_disbursed_amount) - ($total_loan_amount + $total_expenditure_amount);

            $float = number_format((float)$cash_in_hand, 2, '.', '');

            $total_cash_in_hand = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $float);

            return view('reports.cash_in_hand', compact('date','total_cash_in_hand', 'total_deposit_amount', 'total_late_fine_amount', 'total_pre_interest_amount', 'total_interest_amount', 'total_interest_late_fine_amount', 'total_disbursed_amount', 'total_loan_amount', 'total_expenditure_amount'))
                ->with('society', Society::where('society_id', $society_id)->first())
                ->with('members', User::where([['society_id', $society_id], ['society_member', 'yes'], ['status', 'yes']])->get())
                ->with('admins', User::where([['society_id', $society_id], ['status', 'yes']])->wherehas('roles', function($q){
                    $q->where('name', 'admin');
                    })->get());
            }
            elseif($report_type == 'date')
            {
            $total_deposit_amount= Deposit::where([['society_id', $society_id], ['date', $_GET['date']], ['status', 'yes']])->sum('amount');
            $total_late_fine_amount= Deposit::where([['society_id', $society_id], ['date', $_GET['date']], ['status', 'yes']])->sum('fine');
            $total_interest_amount= Interest::where([['society_id', $society_id], ['date', $_GET['date']], ['status', 'yes']])->sum('interest_amount');
            $total_pre_interest_amount= Interest::where([['society_id', $society_id], ['date', $_GET['date']], ['status', 'yes']])->sum('previous_interest');
            $total_interest_late_fine_amount= Interest::where([['society_id', $society_id], ['date', $_GET['date']], ['status', 'yes']])->sum('lif_amount');
            $total_disbursed_amount= Disburse::where([['society_id', $society_id], ['date', $_GET['date']], ['status', 'yes']])->sum('amount');
        
            $total_loan_amount= Loan::where([['society_id', $society_id], ['date', $_GET['date']], ['status', 'yes']])->sum('amount');
            $total_expenditure_amount= Expenditure::where([['society_id', $society_id], ['date', $_GET['date']], ['status', 'yes']])->sum('amount');
        
            $cash_in_hand = ($total_deposit_amount + $total_late_fine_amount + $total_interest_amount + $total_pre_interest_amount + $total_interest_late_fine_amount + $total_disbursed_amount) - ($total_loan_amount + $total_expenditure_amount);

            $float = number_format((float)$cash_in_hand, 2, '.', '');

            $total_cash_in_hand = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $float);

            return view('reports.cash_in_hand', compact('date', 'total_cash_in_hand', 'total_deposit_amount', 'total_late_fine_amount', 'total_pre_interest_amount', 'total_interest_amount', 'total_interest_late_fine_amount', 'total_disbursed_amount', 'total_loan_amount', 'total_expenditure_amount'))
                ->with('society', Society::where('society_id', $society_id)->first())
                ->with('members', User::where([['society_id', $society_id], ['society_member', 'yes'], ['status', 'yes']])->get())
                ->with('admins', User::where([['society_id', $society_id], ['status', 'yes']])->wherehas('roles', function($q){
                    $q->where('name', 'admin');
                    })->get());
            }
        }
        else
        {
        return redirect('/dashboard')
        ->with('access_denied', 'Access Denied');
        }
    }
    
}