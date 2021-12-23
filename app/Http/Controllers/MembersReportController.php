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

class MembersReportController extends Controller
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
        
            return view('members_reports.reports')
                ->with('society', Society::where('society_id', $society_id)->first())
                ->with('members', User::where([['society_id', $society_id], ['society_member', 'yes'], ['status', 'yes']])->orderBy('name', 'ASC')->get());
        }
        else
        {
            return redirect('/dashboard');
        }
    }

    public function report_show()
    {
        if(Auth::user()->hasRole('admin'))
        {
            $usernew = User:: where('id', auth()->user()->id)->first();
            $society_id= $usernew->society_id;
        
            return view('members_reports.show')
                ->with('society', Society::where('society_id', $society_id)->first());
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

            $member_id = $_GET['member_id'];
            
            $report_type = $_GET['report_type'];

            if($report_type == 'all')
            {                  
            $deposit_amount= Deposit::where([['society_id', $society_id], ['user_id', $member_id], ['status', 'yes']])->sum('amount');

            $float = number_format((float)$deposit_amount, 2, '.', '');

            $total_deposit_amount = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $float);

            return view('members_reports.deposit_report', compact('total_deposit_amount', 'date'))
                ->with('society', Society::where('society_id', $society_id)->first())
                ->with('members', User::where([['society_id', $society_id], ['id', $member_id], ['society_member', 'yes'], ['status', 'yes']])->first())
                ->with('admins', User::where([['society_id', $society_id], ['status', 'yes']])->wherehas('roles', function($q){
                    $q->where('name', 'admin');
                    })->get())
                ->with('deposits', Deposit::where([['society_id', $society_id], ['user_id', $member_id], ['status', 'yes']])->orderBy('updated_at', 'DESC')->get());
            }
            elseif($report_type == 'date')
            {
            $deposit_amount= Deposit::where([['society_id', $society_id], ['date', $_GET['date']], ['status', 'yes']])->sum('amount');

            $float = number_format((float)$deposit_amount, 2, '.', '');

            $total_deposit_amount = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $float);
            
            return view('members_reports.deposit_report', compact('total_deposit_amount', 'date'))
                ->with('society', Society::where('society_id', $society_id)->first())
                ->with('members', User::where([['society_id', $society_id], ['society_member', 'yes'], ['id', $member_id], ['status', 'yes']])->first())
                ->with('admins', User::where([['society_id', $society_id], ['status', 'yes']])->wherehas('roles', function($q){
                    $q->where('name', 'admin');
                    })->get())
                ->with('deposits', Deposit::where([['society_id', $society_id], ['user_id', $member_id], ['date', $_GET['date']], ['status', 'yes']])->orderBy('updated_at', 'DESC')->get());
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

            $member_id = $_GET['member_id'];
            
            $report_type = $_GET['report_type'];

            $date = date('jS M Y');

            if($report_type == 'all')
            {           
            $late_fine_amount= Deposit::where([['society_id', $society_id], ['user_id', $member_id], ['status', 'yes']])->sum('fine');

            $float = number_format((float)$late_fine_amount, 2, '.', '');

            $total_late_fine_amount = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $float);
            
            return view('members_reports.late_fine_report', compact('total_late_fine_amount', 'date'))
                ->with('society', Society::where('society_id', $society_id)->first())
                ->with('members', User::where([['society_id', $society_id], ['id', $member_id], ['society_member', 'yes'], ['status', 'yes']])->first())
                ->with('admins', User::where([['society_id', $society_id], ['status', 'yes']])->wherehas('roles', function($q){
                    $q->where('name', 'admin');
                    })->get())
                ->with('late_fines', Deposit::where([['society_id', $society_id], ['user_id', $member_id], ['fine', '!=', '0.00'], ['status', 'yes']])->orderBy('updated_at', 'DESC')->with('user')->get());
            }
            elseif($report_type == 'date')
            {
            $late_fine_amount= Deposit::where([['society_id', $society_id], ['date', $_GET['date']], ['status', 'yes']])->sum('fine');

            $float = number_format((float)$late_fine_amount, 2, '.', '');

            $total_late_fine_amount = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $float);
            
            return view('members_reports.late_fine_report', compact('total_late_fine_amount', 'date'))
                ->with('society', Society::where('society_id', $society_id)->first())
                ->with('members', User::where([['society_id', $society_id], ['id', $member_id], ['society_member', 'yes'], ['status', 'yes']])->first())
                ->with('admins', User::where([['society_id', $society_id], ['status', 'yes']])->wherehas('roles', function($q){
                    $q->where('name', 'admin');
                    })->get())
                ->with('late_fines', Deposit::where([['society_id', $society_id], ['user_id', $member_id], ['date', $_GET['date']], ['fine', '!=', '0.00'], ['status', 'yes']])->orderBy('updated_at', 'DESC')->with('user')->get());
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

            $member_id = $_GET['member_id'];

            $report_type = $_GET['report_type'];

            $date = date('jS M Y');

            if($report_type == 'all')
            {                 
            $loan_amount= Loan::where([['society_id', $society_id], ['user_id', $member_id], ['status', 'yes']])->sum('amount');

            $float = number_format((float)$loan_amount, 2, '.', '');

            $total_loan_amount = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $float);
            
            return view('members_reports.loan_report', compact('total_loan_amount', 'date'))
                ->with('society', Society::where('society_id', $society_id)->first())
                ->with('members', User::where([['society_id', $society_id], ['id', $member_id], ['society_member', 'yes'], ['status', 'yes']])->first())
                ->with('admins', User::where([['society_id', $society_id], ['status', 'yes']])->wherehas('roles', function($q){
                    $q->where('name', 'admin');
                    })->get())
                ->with('loans', Loan::where([['society_id', $society_id], ['user_id', $member_id], ['status', 'yes']])->orderBy('updated_at', 'DESC')->get());
            }
            elseif($report_type == 'date')
            {
            $loan_amount= Loan::where([['society_id', $society_id], ['user_id', $member_id], ['date', $_GET['date']], ['status', 'yes']])->sum('amount');

            $float = number_format((float)$loan_amount, 2, '.', '');

            $total_loan_amount = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $float);
            
            return view('members_reports.loan_report', compact('total_loan_amount', 'date'))
                ->with('society', Society::where('society_id', $society_id)->first())
                ->with('members', User::where([['society_id', $society_id], ['id', $member_id], ['society_member', 'yes'], ['status', 'yes']])->first())
                ->with('admins', User::where([['society_id', $society_id], ['status', 'yes']])->wherehas('roles', function($q){
                    $q->where('name', 'admin');
                    })->get())
                ->with('loans', Loan::where([['society_id', $society_id], ['user_id', $member_id], ['date', $_GET['date']], ['status', 'yes']])->orderBy('updated_at', 'DESC')->get());
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
            
            $member_id = $_GET['member_id'];
            $report_type = $_GET['report_type'];

            $date = date('jS M Y');

            if($report_type == 'all')
            {           
            $interest_amount= Interest::where([['society_id', $society_id], ['user_id', $member_id], ['status', 'yes']])->sum('total_interest');

            $float = number_format((float)$interest_amount, 2, '.', '');

            $total_interest_amount = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $float);
        
            return view('members_reports.interest_report', compact('total_interest_amount', 'date'))
                ->with('society', Society::where('society_id', $society_id)->first())
                ->with('members', User::where([['society_id', $society_id], ['id', $member_id], ['society_member', 'yes'], ['status', 'yes']])->first())
                ->with('admins', User::where([['society_id', $society_id], ['status', 'yes']])->wherehas('roles', function($q){
                    $q->where('name', 'admin');
                    })->get())
                ->with('interests', Interest::where([['society_id', $society_id], ['user_id', $member_id], ['status', 'yes']])->orderBy('updated_at', 'DESC')->with('user')->get());
            }
            elseif($report_type == 'date')
            {
            $interest_amount= Interest::where([['society_id', $society_id], ['user_id', $member_id], ['date', $_GET['date']], ['status', 'yes']])->sum('total_interest');

            $float = number_format((float)$interest_amount, 2, '.', '');

            $total_interest_amount = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $float);
        
            return view('members_reports.interest_report', compact('total_interest_amount', 'date'))
                ->with('society', Society::where('society_id', $society_id)->first())
                ->with('members', User::where([['society_id', $society_id], ['id', $member_id], ['society_member', 'yes'], ['status', 'yes']])->first())
                ->with('admins', User::where([['society_id', $society_id], ['status', 'yes']])->wherehas('roles', function($q){
                    $q->where('name', 'admin');
                    })->get())
                ->with('interests', Interest::where([['society_id', $society_id], ['user_id', $member_id], ['date', $_GET['date']], ['status', 'yes']])->orderBy('updated_at', 'DESC')->with('user')->get());
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

            $member_id = $_GET['member_id'];

            $report_type = $_GET['report_type'];

            $date = date('jS M Y');

            if($report_type == 'all')
            {                  
            $disbursed_amount= Disburse::where([['society_id', $society_id], ['user_id', $member_id], ['status', 'yes']])->sum('amount');

            $float = number_format((float)$disbursed_amount, 2, '.', '');

            $total_disbursed_amount = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $float);

            return view('members_reports.disbursed_report', compact('total_disbursed_amount', 'date'))
                ->with('society', Society::where('society_id', $society_id)->first())
                ->with('members', User::where([['society_id', $society_id], ['id', $member_id], ['society_member', 'yes'], ['status', 'yes']])->first())
                ->with('admins', User::where([['society_id', $society_id], ['status', 'yes']])->wherehas('roles', function($q){
                    $q->where('name', 'admin');
                    })->get())
                ->with('disburses', Disburse::where([['society_id', $society_id], ['user_id', $member_id], ['status', 'yes']])->orderBy('updated_at', 'DESC')->with('user')->get());
            }
            elseif($report_type == 'date')
            {
            $disbursed_amount= Disburse::where([['society_id', $society_id], ['user_id', $member_id], ['date', $_GET['date']], ['status', 'yes']])->sum('amount');

            $float = number_format((float)$disbursed_amount, 2, '.', '');

            $total_disbursed_amount = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $float);

            return view('members_reports.disbursed_report', compact('total_disbursed_amount', 'date'))
                ->with('society', Society::where('society_id', $society_id)->first())
                ->with('members', User::where([['society_id', $society_id], ['id', $member_id], ['society_member', 'yes'], ['status', 'yes']])->first())
                ->with('admins', User::where([['society_id', $society_id], ['status', 'yes']])->wherehas('roles', function($q){
                    $q->where('name', 'admin');
                    })->get())
                ->with('disburses', Disburse::where([['society_id', $society_id], ['user_id', $member_id], ['date', $_GET['date']], ['status', 'yes']])->orderBy('updated_at', 'DESC')->with('user')->get());
            }
        }
        else
        {
            return redirect('/dashboard')
            ->with('access_denied', 'Access Denied');
        }
    }
}