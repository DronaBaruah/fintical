<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\User;
use App\Models\Society;
use App\Models\Loan;
use App\Models\Disburse;

class LoanController extends Controller
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
        
            return view('loan.selectuser')
                ->with('society', Society::where('society_id', $society_id)->first())
                ->with('members', User::where([['society_id', $society_id], ['society_member', 'yes'], ['status', 'yes']])->orderBy('name', 'ASC')->get())
                ->with('loans', Loan::where([['society_id', $society_id], ['status', 'yes']])->orderBy('updated_at', 'DESC')->with('user')->get());
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
                return redirect('/loan')
                ->with('message', 'Please Select Member');
            }

            if($society_id == $member->society_id ){

                session(['user_id' => $userid ]);

                $total_loan_amount= Loan::where([['user_id', $userid], ['status', 'yes']])->sum('amount');
                $total_disburse_amount= Disburse::where([['user_id', $userid], ['status', 'yes']])->sum('amount');

                $total_due_amount = $total_loan_amount - $total_disburse_amount;                
            
                return view('loan.loanform', compact('total_due_amount'))
                ->with('member', User::where('id', $userid)->first())
                ->with('society', Society::where('society_id', $society_id)->first());
            
            }
            else
            {
                return redirect('/loan');
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
                'amount'=> 'required',
                'date'=> 'required'
            ]);

            $usernew = User:: where('id', auth()->user()->id)->first();
            $society_id= $usernew->society_id;

            $user_id = session()->get('user_id');

            $loan_id = IdGenerator::generate(['table' => 'loans', 'field'=>'loan_id', 'length' => 10, 'prefix' => 'L1']);
                
            Loan::create([
                    'loan_id' => $loan_id,
                    'society_id' => $society_id,
                    'user_id' => $user_id,
                    'date' => $request->input('date'),
                    'amount' => $request->input('amount'),
                    'remark' => $request->input('remark'),
                    'status' => 'yes',
                    'admin_id' => auth()->user()->id
                ]);

                $request->session()->regenerate();
                return redirect('/loan')
                    ->with('message', 'Loan Record Has been Added')
                    ->with('transaction_id', 'Loan Transaction ID : ' . $loan_id);
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
            $loan = Loan:: where([['id', $id], ['society_id', Auth::user()->society_id], ['status', 'yes']])->first();
                      
            if($loan== null)
            {
                return redirect('/loan')
                ->with('access_denied', 'Access Denied');
            }

            $total_loan_amount= Loan::where([['user_id', $loan->user_id], ['status', 'yes']])->sum('amount');
            $total_disburse_amount= Disburse::where([['user_id', $loan->user_id], ['status', 'yes']])->sum('amount');

            $total_due_amount = $total_loan_amount - $total_disburse_amount;  

            $member = User::where([['id', $loan->user_id], ['society_id', Auth::user()->society_id], ['society_member', 'yes']])->first();
        
            return view('loan.show', compact('loan', 'member', 'total_due_amount'))
                ->with('society', Society::where('society_id', Auth::user()->society_id)->first())
                ->with('loan_data', Loan::where([['society_id', Auth::user()->society_id], ['status', 'yes']])->orderBy('updated_at', 'DESC')->with('user')->get());
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
        if(Auth::user()->hasRole('admin'))
            {
            $loan = Loan:: where([['id', $id], ['society_id', Auth::user()->society_id], ['status', 'yes']])->first();
                      
            if($loan== null)
            {
                return redirect('/loan')
                ->with('access_denied', 'Access Denied');
            }

            $total_loan_amount= Loan::where([['user_id', $loan->user_id], ['status', 'yes']])->sum('amount');
            $total_disburse_amount= Disburse::where([['user_id', $loan->user_id], ['status', 'yes']])->sum('amount');

            $total_due_amount = $total_loan_amount - $total_disburse_amount;  

            $member = User::where([['id', $loan->user_id], ['society_id', Auth::user()->society_id], ['society_member', 'yes']])->first();
        
            return view('loan.edit', compact('loan', 'member', 'total_due_amount'))
                ->with('society', Society::where('society_id', Auth::user()->society_id)->first())
                ->with('loan_data', Loan::where([['society_id', Auth::user()->society_id], ['status', 'yes']])->orderBy('updated_at', 'DESC')->with('user')->get());
        }
        else
        {
            return redirect('/dashboard')
                ->with('access_denied', 'Access Denied');
        }
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
        if(Auth::user()->hasRole('admin'))
        {
            $request->validate([
                'amount'=> 'required',
                'date'=> 'required'
            ]);

            $loan = Loan:: where([['id', $id], ['society_id', Auth::user()->society_id], ['status', 'yes']])->first();
                      
            if($loan == null)
            {
                return redirect('/loan')
                ->with('access_denied', 'Access Denied');
            }
                
            Loan::where('id', $id)->update([
                    'date' => $request->input('date'),
                    'amount' => $request->input('amount'),
                    'remark' => $request->input('remark'),
                    'admin_id' => auth()->user()->id
                ]);

                $request->session()->regenerate();
                return redirect('/loan')
                    ->with('message', 'Loan Record Has been Updated')
                    ->with('transaction_id', 'Loan Transaction ID : ' . $loan->loan_id);
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
            $loan = Loan:: where([['id', $id], ['society_id', Auth::user()->society_id], ['status', 'yes']])->first();
                    
            if($loan== null)
            {
                return redirect('/loan')
                ->with('access_denied', 'Access Denied');
            }

            Loan::where('id', $id)->update([            
                'status' => 'no',
                'admin_id' => auth()->user()->id
            ]);
            
            $request->session()->regenerate();
            return redirect('/loan')
                ->with('message', 'Loan Record Has been Deleted');
        }
        else
        {
            return redirect('/loan')
                ->with('access_denied', 'Access Denied');
        }
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