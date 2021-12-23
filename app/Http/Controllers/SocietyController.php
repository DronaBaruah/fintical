<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\Society;

class SocietyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::guest())
        {
            return view('auth.societyregister');
        }
        elseif((Auth::user()))
        {
            session()->invalidate();
            session()->regenerateToken();
            return redirect('/society');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     return redirect('/society');
    //  }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required',
            'address'=> 'required',
            'share_value'=> 'required',
            'phone_no'=> 'required|max:10|unique:societies',
            'society_type'=> 'required',
            'lending_interest_rate'=> 'required',
            'society_start'=> 'required',
            'society_end'=> 'required'
        ]);

        $society_id = IdGenerator::generate(['table' => 'societies', 'field'=>'society_id', 'length' => 5, 'prefix' => 'S1']);
        
        // Society::create([
        //         'society_id' => $society_id,
        //         'name' => $request->input('name'),
        //         'address' => $request->input('address'),
        //         'share_value' => $request->input('share_value'),
        //         'phone_no' => $request->input('phone_no'),
        //         'society_type' => $request->input('society_type'),
        //         'lending_interest_rate' => $request->input('lending_interest_rate'),
        //         'society_start' => $request->input('society_start'),
        //         'society_end' => $request->input('society_end'),
        //         'status' => 'yes'
        //     ]);

            session(['society_id' => $society_id ]);
            session(['society_name' => $request->input('name')]);
            session(['address' => $request->input('address')]);
            session(['share_value' => $request->input('share_value')]);
            session(['phone_no' => $request->input('phone_no')]);
            session(['society_type' => $request->input('society_type')]);
            session(['lending_interest_rate' => $request->input('lending_interest_rate')]);
            session(['society_start' => $request->input('society_start')]);
            session(['society_end' => $request->input('society_end')]);
                        
            session()->regenerate();
            return redirect('/admin_register')
                ->with('message', 'Your society Has been Added');      
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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