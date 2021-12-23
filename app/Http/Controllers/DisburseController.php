<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Society;
use App\Models\Loan;
use App\Models\Disburse;

class DisburseController extends Controller
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
        
            return view('disburse.selectuser', compact('members'))
                ->with('society', Society::where('society_id', $society_id)->first())             
                ->with('disburses', Disburse::where([['society_id', $society_id], ['status', 'yes']])->orderBy('updated_at', 'DESC')->with('user')->get());
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
                    return redirect('/loan_repayment')
                    ->with('members', User::where('society_id', $society_id)->get());
                }

                if($society_id == $member->society_id ){

                    session(['user_id' => $userid ]);

                    $total_loan_amount= Loan::where([['user_id', $userid], ['status', 'yes']])->sum('amount');
                    $total_disburse_amount= Disburse::where([['user_id', $userid], ['status', 'yes']])->sum('amount');

                    $total_due_amount = $total_loan_amount - $total_disburse_amount;
                                    
                    return view('disburse.disburseform', compact('total_due_amount'))
                    ->with('member', User::where('id', $userid)->first())
                    ->with('society', Society::where('society_id', $society_id)->first());
                
                }
                else
                {
                    return redirect('/loan_repayment')
                    ->with('members', User::where('society_id', $society_id)->get());
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

                $total_loan_amount= Loan::where([['user_id', $user_id], ['status', 'yes']])->sum('amount');
                $total_disburse_amount= Disburse::where([['user_id', $user_id], ['status', 'yes']])->sum('amount');

                $total_due_amount = $total_loan_amount - $total_disburse_amount;

                if($request->input('amount') > $total_due_amount)
                {
                    return back()
                        ->with('message', 'Repayment amount can`t be more than the Loan Due');
                }

                $disburse_id = IdGenerator::generate(['table' => 'disburses', 'field'=>'disburse_id', 'length' => 10, 'prefix' => 'DB1']);

                Disburse::create([
                        'disburse_id' => $disburse_id,
                        'society_id' => $society_id,
                        'user_id' => $user_id,
                        'date' => $request->input('date'),
                        'amount' => $request->input('amount'),
                        'remark' => $request->input('remark'),
                        'status' => 'yes',
                        'admin_id' => auth()->user()->id
                    ]);

                    $request->session()->regenerate();
                    return redirect('/loan_repayment')
                        ->with('message', 'Repayment Record Has been Added')                        
                        ->with('transaction_id', 'Repayment Transaction ID : ' . $disburse_id);

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
            $disburse = Disburse:: where([['id', $id], ['society_id', Auth::user()->society_id], ['status', 'yes']])->first();
                      
            if($disburse== null)
            {
                return redirect('/loan_repayment')
                ->with('access_denied', 'Access Denied');
            }

            $total_loan_amount= Loan::where([['user_id', $disburse->user_id], ['status', 'yes']])->sum('amount');
            $total_disburse_amount= Disburse::where([['user_id', $disburse->user_id], ['status', 'yes']])->sum('amount');

            $total_due_amount = $total_loan_amount - $total_disburse_amount;

            $member = User::where([['id', $disburse->user_id], ['society_id', Auth::user()->society_id], ['society_member', 'yes']])->first();
        
            return view('disburse.show', compact('disburse', 'member', 'total_due_amount'))
                ->with('society', Society::where('society_id', Auth::user()->society_id)->first())
                ->with('disburse_data', Disburse::where([['society_id', Auth::user()->society_id], ['status', 'yes']])->orderBy('updated_at', 'DESC')->with('user')->get());
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
            $disburse = Disburse:: where([['id', $id], ['society_id', Auth::user()->society_id], ['status', 'yes']])->first();
                      
            if($disburse== null)
            {
                return redirect('/loan_repayment')
                ->with('access_denied', 'Access Denied');
            }

            $total_loan_amount= Loan::where([['user_id', $disburse->user_id], ['status', 'yes']])->sum('amount');
            $total_disburse_amount= Disburse::where([['user_id', $disburse->user_id], ['status', 'yes']])->sum('amount');

            $total_due_amount = $total_loan_amount - $total_disburse_amount;

            $member = User::where([['id', $disburse->user_id], ['society_id', Auth::user()->society_id], ['society_member', 'yes']])->first();
        
            return view('disburse.edit', compact('disburse', 'member', 'total_due_amount'))
                ->with('society', Society::where('society_id', Auth::user()->society_id)->first())
                ->with('disburse_data', Disburse::where([['society_id', Auth::user()->society_id], ['status', 'yes']])->orderBy('updated_at', 'DESC')->with('user')->get());
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

                $disburse = Disburse:: where([['id', $id], ['society_id', Auth::user()->society_id], ['status', 'yes']])->first();
                      
                if($disburse== null)
                {
                    return redirect('/loan_repayment')
                    ->with('access_denied', 'Access Denied');
                }

                $total_loan_amount= Loan::where([['user_id', $disburse->user_id], ['status', 'yes']])->sum('amount');
                $total_disburse_amount= Disburse::where([['user_id', $disburse->user_id], ['status', 'yes']])->sum('amount');

                $total_due_amount = $total_loan_amount - $total_disburse_amount + $request->input('amount');

                if($request->input('amount') > $total_due_amount)
                {
                    return back()
                        ->with('message', 'Repayment amount can`t be more than the Loan Due');
                }

                Disburse::where('id', $id)->update([
                        'date' => $request->input('date'),
                        'amount' => $request->input('amount'),
                        'remark' => $request->input('remark'),
                        'admin_id' => auth()->user()->id
                    ]);

                    $request->session()->regenerate();
                    return redirect('/loan_repayment')
                        ->with('message', 'Repayment Record Has been Updated')                        
                        ->with('transaction_id', 'Repayment Transaction ID : ' . $disburse->disburse_id);

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
              
            $disburse = Disburse:: where([['id', $id], ['society_id', Auth::user()->society_id], ['status', 'yes']])->first();
                    
            if($disburse== null)
            {
                return redirect('/loan_repayment')
                ->with('access_denied', 'Access Denied');
            }

            Disburse::where('id', $id)->update([            
                'status' => 'no',
                'admin_id' => auth()->user()->id
            ]);
            
            $request->session()->regenerate();
            return redirect('/loan_repayment')
                ->with('message', 'Repayment Record Has been Deleted');
        }
        else
        {
            return redirect('/dashboard')
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