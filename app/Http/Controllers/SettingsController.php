<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Society;
use App\Models\Deposit;
use App\Models\Interest;
use App\Models\Interestnonpay;
use App\Models\Loan;
use App\Models\Disburse;
use App\Models\Expenditure;

use Illuminate\Http\Request;

class SettingsController extends Controller
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
            $society = Society:: where('society_id', auth()->user()->society_id)->first();

            // dd($society);

            if($society == null)
            {
                return redirect('/dashboard')
                ->with('access_denied', 'Access Denied');
            }
        
            return view('settings.society')
                ->with('society', Society::where('society_id', auth()->user()->society_id)->first())
                ->with('admins', User::where([['society_id', auth()->user()->society_id], ['status', 'yes']])->wherehas('roles', function($q){
                $q->where('name', 'admin');
                })->get());
            }
        else
            {
                return redirect('/dashboard')
                ->with('access_denied', 'Access Denied');
            }
    }

    public function edit($id)
    {
        if(Auth::user()->hasRole('admin'))
        {
        $society = Society:: where('society_id', auth()->user()->society_id)->first();

        // dd($society);

        if($society == null)
        {
            return redirect('/dashboard')
            ->with('access_denied', 'Access Denied');
        }
    
        return view('settings.edit')
            ->with('society', Society::where('society_id', auth()->user()->society_id)->first())
            ->with('admins', User::where([['society_id', auth()->user()->society_id], ['status', 'yes']])->wherehas('roles', function($q){
            $q->where('name', 'admin');
            })->get());
        }
    else
        {
            return redirect('/dashboard')
            ->with('access_denied', 'Access Denied');
        }
    }

    public function destroy(Request $request, $id)
    {
        if(Auth::user()->hasRole('admin'))
        {
            $request->validate([
                'records'=> 'required',
            ]);

            $user = User::where([['society_id', $id], ['society_id', Auth::user()->society_id], ['status', 'yes']])->first();
            
            if($user == null)
            {
                return redirect('/dashboard')
                ->with('access_denied', 'Access Denied');
            }

            $society = Society:: where([['society_id', auth()->user()->society_id], ['status', 'yes']])->first();
            
            if($society == null)
            {
                return redirect('/dashboard')
                ->with('access_denied', 'Access Denied');
            }

           // dd($request->input('all'));

            if($request->input('all') == 'all'){

                $deposit = Deposit:: where([['society_id', auth()->user()->society_id]])->delete();
                $loan = Loan:: where([['society_id', auth()->user()->society_id]])->delete();
                $interest = Interest:: where([['society_id', auth()->user()->society_id]])->delete();
                $Interestnonpay = Interestnonpay:: where([['society_id', auth()->user()->society_id]])->delete();
                $expenditure = Expenditure:: where([['society_id', auth()->user()->society_id]])->delete();
                $disburse = Disburse:: where([['society_id', auth()->user()->society_id]])->delete();

                $society = Society:: where([['society_id', auth()->user()->society_id]])->delete();
                $users = User:: where([['society_id', auth()->user()->society_id]])->delete();

                session()->regenerate();
            
                return redirect('/login')
                    ->with('message', 'Society Has been Deleted');
            }

            if($request->input('members') == 'members'){

                $deposit = Deposit:: where([['society_id', auth()->user()->society_id]])->delete();
                $loan = Loan:: where([['society_id', auth()->user()->society_id]])->delete();
                $interest = Interest:: where([['society_id', auth()->user()->society_id]])->delete();
                $Interestnonpay = Interestnonpay:: where([['society_id', auth()->user()->society_id]])->delete();
                $expenditure = Expenditure:: where([['society_id', auth()->user()->society_id]])->delete();
                $disburse = Disburse:: where([['society_id', auth()->user()->society_id]])->delete();

                $users = User:: where([['society_id', auth()->user()->society_id], ['id', '!=', auth()->user()->id]])->delete();

                return redirect('/dashboard')
                    ->with('access_denied', 'Society Has been Updated');
            }

            if($request->input('records') == 'records'){

                $deposit = Deposit:: where([['society_id', auth()->user()->society_id]])->delete();
                $loan = Loan:: where([['society_id', auth()->user()->society_id]])->delete();
                $interest = Interest:: where([['society_id', auth()->user()->society_id]])->delete();
                $Interestnonpay = Interestnonpay:: where([['society_id', auth()->user()->society_id]])->delete();
                $expenditure = Expenditure:: where([['society_id', auth()->user()->society_id]])->delete();
                $disburse = Disburse:: where([['society_id', auth()->user()->society_id]])->delete();

                return redirect('/dashboard')
                    ->with('access_denied', 'Society Transaction Has been Deleted');
            }   
       
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=> 'required',
            'address'=> 'required',
            'share_value'=> 'required',
            'phone_no'=> 'required|max:10|unique:societies,phone_no,' .$id ,
            'society_type'=> 'required',
            'lending_interest_rate'=> 'required',
            'society_start'=> 'required',
            'society_end'=> 'required'
        ]);
        
        Society::where('id', $id)->update([
                'name' => $request->input('name'),
                'address' => $request->input('address'),
                'share_value' => $request->input('share_value'),
                'phone_no' => $request->input('phone_no'),
                'society_type' => $request->input('society_type'),
                'lending_interest_rate' => $request->input('lending_interest_rate'),
                'society_start' => $request->input('society_start'),
                'society_end' => $request->input('society_end'),
            ]);
                        
            session()->regenerate();
            return redirect('/settings')
                ->with('message', 'Your Society Has been Updated');  
    }
}