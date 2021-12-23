<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\User;
use App\Models\Society;
use App\Models\Deposit;

class DepositController extends Controller
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
        
            return view('deposit.selectuser')
                ->with('society', Society::where('society_id', $society_id)->first())
                ->with('members', User::where([['society_id', $society_id], ['society_member', 'yes'], ['status', 'yes']])->orderBy('name', 'ASC')->get())
                ->with('deposits', Deposit::where([['society_id', $society_id], ['status', 'yes']])->orderBy('updated_at', 'DESC')->with('user')->get());
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
    

    public function create(Request $request)
    {       
         
        if(Auth::user()->hasRole('admin'))
        {
            $usernew = User:: where('id', auth()->user()->id)->first();
            $society_id= $usernew->society_id;

            $userid = $_GET['userid'];

            $member = User::where('id', $userid)->first();

            if($member == null)
            {
                return redirect('/deposit')
                ->with('message', 'Please Select Member');
            }

            if($society_id == $member->society_id ){

                session(['user_id' => $userid ]);
            
                return view('deposit.depositform')
                ->with('member', User::where([['id', $userid], ['society_member', 'yes'], ['status', 'yes']])->first())
                ->with('society', Society::where('society_id', $society_id)->first());
            }
            else
            {
                return redirect('/deposit');
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
                'date'=> 'required',
                'month'=> 'required'
            ]);

            $usernew = User:: where('id', auth()->user()->id)->first();
            $society_id= $usernew->society_id;

            $user_id = session()->get('user_id');

            if($request->input('fine') == null){
                $fine = 0;
            }
            else
            {
                $fine = $request->input('fine');
            }
            
            $deposit_id = IdGenerator::generate(['table' => 'deposits', 'field'=>'deposit_id', 'length' => 10, 'prefix' => 'D1']);

            Deposit::create([
                    'society_id' => $society_id,
                    'deposit_id' => $deposit_id,
                    'user_id' => $user_id,
                    'month' => $request->input('month'),
                    'date' => $request->input('date'),
                    'amount' => $request->input('amount'),
                    'fine' => $fine,
                    'remark' => $request->input('remark'),
                    'status' => 'yes',
                    'admin_id' => auth()->user()->id
                ]);
                
                $request->session()->regenerate();
                return redirect('/deposit')
                    ->with('message', 'Deposit Record Has been Added')
                    ->with('transaction_id', 'Deposit Transaction ID : ' . $deposit_id);
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
            $deposit = Deposit:: where([['id', $id], ['society_id', Auth::user()->society_id], ['status', 'yes']])->first();
                      
            if($deposit== null)
            {
                return redirect('/deposit')
                ->with('access_denied', 'Access Denied');
            }

            $member = User::where([['id', $deposit->user_id], ['society_id', Auth::user()->society_id], ['society_member', 'yes']])->first();
        
            return view('deposit.show', compact('deposit', 'member'))
                ->with('society', Society::where('society_id', Auth::user()->society_id)->first())
                ->with('deposit_data', Deposit::where([['society_id', Auth::user()->society_id], ['status', 'yes']])->orderBy('updated_at', 'DESC')->with('user')->get());
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
        $deposit = Deposit:: where([['id', $id], ['society_id', Auth::user()->society_id], ['status', 'yes']])->first();
                  
        if($deposit== null)
        {
            return redirect('/deposit')
            ->with('access_denied', 'Access Denied');
        }

        $member = User::where([['id', $deposit->user_id], ['society_id', Auth::user()->society_id], ['society_member', 'yes']])->first();
    
        return view('deposit.edit', compact('deposit', 'member'))
            ->with('society', Society::where('society_id', Auth::user()->society_id)->first())
            ->with('deposit_data', Deposit::where([['society_id', Auth::user()->society_id], ['status', 'yes']])->orderBy('updated_at', 'DESC')->with('user')->get());
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
                'date'=> 'required',
                'month'=> 'required'
            ]);
            
            $deposit = Deposit:: where([['id', $id], ['society_id', Auth::user()->society_id], ['status', 'yes']])->first();
                    
            if($deposit== null)
            {
                return redirect('/deposit')
                ->with('access_denied', 'Access Denied');
            }

            if($request->input('fine') == null){
                $fine = 0;
            }
            else
            {
                $fine = $request->input('fine');
            }

            Deposit::where('id', $id)->update([           
                'month' => $request->input('month'),
                'date' => $request->input('date'),
                'amount' => $request->input('amount'),
                'fine' => $fine,
                'remark' => $request->input('remark'),
                'admin_id' => auth()->user()->id
            ]);
            
            $request->session()->regenerate();
            return redirect('/deposit')
                ->with('message', 'Deposit Record Has been Updated')
                ->with('transaction_id', 'Deposit Transaction ID : ' . $deposit->deposit_id);
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
              
            $deposit = Deposit:: where([['id', $id], ['society_id', Auth::user()->society_id], ['status', 'yes']])->first();
                    
            if($deposit== null)
            {
                return redirect('/deposit')
                ->with('access_denied', 'Access Denied');
            }

            Deposit::where('id', $id)->update([            
                'status' => 'no',
                'admin_id' => auth()->user()->id
            ]);
            
            $request->session()->regenerate();
            return redirect('/deposit')
                ->with('message', 'Deposit Record Has been Deleted');
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