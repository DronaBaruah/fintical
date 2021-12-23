<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\User;
use App\Models\Society;
use App\Models\Expenditure;

use Illuminate\Http\Request;

class ExpenditureController extends Controller
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
        $usernew = User:: where('id', auth()->user()->id)->first();
        $society_id= $usernew->society_id;
        
        $total_expenditure_amount= Expenditure::where([['society_id', $society_id], ['status', 'yes']])->sum('amount');
        
        return view('expenditure.index', compact('total_expenditure_amount'))
            ->with('society', Society::where('society_id', $society_id)->first())
            ->with('expenditures', Expenditure::where([['society_id', $society_id], ['status', 'yes']])->orderby('updated_at', 'DESC')->get());
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

            $total_expenditure_amount= Expenditure::where([['society_id', $society_id], ['status', 'yes']])->sum('amount');

            return view('expenditure.expenditure', compact('total_expenditure_amount'))
                ->with('society', Society::where('society_id', $society_id)->first());
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
                
                $expenditure_id = IdGenerator::generate(['table' => 'expenditures', 'field'=>'expenditure_id', 'length' => 8, 'prefix' => 'E1']);

                Expenditure::create([
                        'expenditure_id' => $expenditure_id,
                        'society_id' => $society_id,
                        'date' => $request->input('date'),
                        'amount' => $request->input('amount'),
                        'remark' => $request->input('remark'),
                        'status' => 'yes',
                        'admin_id' => auth()->user()->id
                    ]);

                    $request->session()->regenerate();
                    return redirect('/expenditure')
                        ->with('message', 'Expenditure Record Has been Added')
                        ->with('transaction_id', 'Expenditure Transaction ID : ' . $expenditure_id);
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
        $expenditure = Expenditure:: where([['id', $id], ['society_id', Auth::user()->society_id], ['status', 'yes']])->first();
                    
        if($expenditure == null)
        {
            return redirect('/expenditure')
            ->with('access_denied', 'Access Denied');
        }

        $total_expenditure_amount= Expenditure::where([['society_id', Auth::user()->society_id], ['status', 'yes']])->sum('amount');

        return view('expenditure.show', compact('total_expenditure_amount','expenditure' ))
            ->with('society', Society::where('society_id', Auth::user()->society_id)->first());       
    }


    public function delete_update(Request $request, $id)
    {
        if(Auth::user()->hasRole('admin'))
        {
            $expenditure = Expenditure:: where([['id', $id], ['society_id', Auth::user()->society_id], ['status', 'yes']])->first();
                    
            if($expenditure== null)
            {
                return redirect('/expenditure')
                ->with('access_denied', 'Access Denied');
            }

            Expenditure::where('id', $id)->update([            
                'status' => 'no',
                'admin_id' => auth()->user()->id
            ]);
            
            $request->session()->regenerate();
            return redirect('/expenditure')
                ->with('message', 'Expenditure Record Has been Deleted');
        }
        else
        {
            return redirect('/expenditure')
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