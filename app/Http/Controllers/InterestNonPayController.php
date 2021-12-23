<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\User;
use App\Models\Society;
use App\Models\Loan;
use App\Models\Disburse;
use App\Models\Interest;
use App\Models\Interestnonpay;

use Illuminate\Http\Request;

class InterestNonPayController extends Controller
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
    public function index()
    {
        if(Auth::user()->hasRole('admin'))
        {
            $usernew = User:: where('id', auth()->user()->id)->first();
            $society_id= $usernew->society_id;

            $members = User::where([['society_id', Auth::user()->society_id], ['society_member', 'yes'], ['status', 'yes']])->with('loan', function($query) 
            {$query->where([['status', 'yes']])->sum('amount');})->with('disburse', function($query1) 
            {$query1->where([['status', 'yes']])->sum('amount');})->get();
        
            return view('interest_non_pay.selectuser', compact('members'))
                ->with('society', Society::where('society_id', $society_id)->first())               
                ->with('Interestnonpays', Interestnonpay::where([['society_id', $society_id], ['status', 'yes']])->orderBy('updated_at', 'DESC')->with('user')->get());
        }
        else
        {
            return redirect('/dashboard')
            ->with('access_denied', 'Access Denied');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->hasRole('admin'))
        {
            $usernew = User:: where('id', auth()->user()->id)->first();
            $society_id= $usernew->society_id;

            $userid = $_GET['userid'];

            $member = User::where('id', $userid)->first();

            if($member == null)
            {
                return redirect('/interest_non_payment')                
                ->with('message', 'Please Select Member');
            }

           
            if($society_id == $member->society_id ){

                session(['user_id' => $userid ]);

                //loan due
                $total_loan_amount= Loan::where([['user_id', $userid], ['status', 'yes']])->sum('amount');
                $total_disburse_amount= Disburse::where([['user_id', $userid], ['status', 'yes']])->sum('amount');

                $total_due_amount = $total_loan_amount - $total_disburse_amount;

                //interest non payment
                $interest_non_pay= Interestnonpay::where([['user_id', $userid], ['status', 'yes']])->sum('interest_non_pay');
                $previous_interest= Interest::where([['user_id', $userid], ['status', 'yes']])->sum('previous_interest');

                $total_interest_non_pay = $interest_non_pay - $previous_interest;
                            
                return view('interest_non_pay.interest_non_pay_form', compact('total_due_amount', 'total_interest_non_pay'))
                ->with('member', User::where('id', $userid)->first())
                ->with('society', Society::where('society_id', $society_id)->first());
            
            }
            else
            {
                return redirect('/interest_non_pay');
            }
        }
        else
        {
            return redirect('/dashboard')
            ->with('access_denied', 'Access Denied');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->hasRole('admin'))
        {
            $request->validate([
                'pre_non_pay'=> 'required',
                'interest_non_pay'=> 'required',
                'total_interest_non_pay'=> 'required|numeric',
                'date'=> 'required'
            ]);

            $usernew = User:: where('id', auth()->user()->id)->first();
            $society_id= $usernew->society_id;

            $user_id = session()->get('user_id');
           
            $interest_non_pay_id = IdGenerator::generate(['table' => 'interestnonpays', 'field'=>'interest_non_pay_id', 'length' => 10, 'prefix' => 'INP1']);

            Interestnonpay::create([
                    'interest_non_pay_id' => $interest_non_pay_id,
                    'society_id' => $society_id,
                    'user_id' => $user_id,
                    'date' => $request->input('date'),
                    'interest_non_pay' => $request->input('interest_non_pay'),
                    'remark' => $request->input('remark'),
                    'status' => 'yes',
                    'admin_id' => auth()->user()->id
                ]);

                $request->session()->regenerate();
                return redirect('/interest_non_payment')
                    ->with('message', 'Interest Non Payment Record Has been Added')
                    ->with('transaction_id', 'Interest Non Payment Transaction ID : ' . $interest_non_pay_id);
        }
        else
        {
            return redirect('/dashboard')
            ->with('access_denied', 'Access Denied');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()->hasRole('admin'))
        {
            $interestnonpay = Interestnonpay:: where([['id', $id], ['society_id', Auth::user()->society_id], ['status', 'yes']])->first();
                      
            if($interestnonpay == null)
            {
                return redirect('/interest_non_payment')
                ->with('access_denied', 'Access Denied');
            }
                //loan due
                $total_loan_amount= Loan::where([['user_id', $interestnonpay->user_id], ['status', 'yes']])->sum('amount');
                $total_disburse_amount= Disburse::where([['user_id', $interestnonpay->user_id], ['status', 'yes']])->sum('amount');

                $total_due_amount = $total_loan_amount - $total_disburse_amount;

                //interest non payment
                $interest_non_pay= Interestnonpay::where([['user_id', $interestnonpay->user_id], ['status', 'yes']])->sum('interest_non_pay');
                $previous_interest= Interest::where([['user_id', $interestnonpay->user_id], ['status', 'yes']])->sum('previous_interest');

                $total_interest_non_pay = $interest_non_pay - $previous_interest;
                            
                return view('interest_non_pay.show', compact('total_due_amount', 'total_interest_non_pay', 'interestnonpay'))
                ->with('member', User::where('id', $interestnonpay->user_id)->first())
                ->with('society', Society::where('society_id', Auth::user()->society_id)->first())
                ->with('Interestnonpays', Interestnonpay::where([['society_id', Auth::user()->society_id], ['status', 'yes']])->orderBy('updated_at', 'DESC')->with('user')->get());      
         
        }
        else
        {
            return redirect('/dashboard')
            ->with('access_denied', 'Access Denied');
        }
    }


    public function delete_update(Request $request, $id)
    {
        if(Auth::user()->hasRole('admin'))
        {
            $interestnonpay = Interestnonpay:: where([['id', $id], ['society_id', Auth::user()->society_id], ['status', 'yes']])->first();
                    
            if($interestnonpay== null)
            {
                return redirect('/interest_non_payment')
                ->with('access_denied', 'Access Denied');
            }

            Interestnonpay::where('id', $id)->update([            
                'status' => 'no',
                'admin_id' => auth()->user()->id
            ]);
            
            $request->session()->regenerate();
            return redirect('/interest_non_payment')
                ->with('message', 'Interest Non Payment Record Has been Deleted');
        }
        else
        {
            return redirect('/dashboard')
                ->with('access_denied', 'Access Denied');
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}