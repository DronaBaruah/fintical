<?php

namespace App\Http\Controllers;

//namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\Society;

class RegisteredAdminController extends Controller
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
            if(session()->get('society_id') != null)
            {
                return view('auth.adminregister');
            }
            else
            {
               return redirect('/society');
            }
        }
        elseif((Auth::user()))
        {
            session()->flush();
            session()->regenerate();
            return redirect('/society');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'user_name' => 'required|string|max:255|unique:users',
            'phone_no' => 'required|string|max:10',
            'address' => 'required|string',
            'society_member' => 'required|string',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if($request->society_member == 'no'){
            $share_no = 0;
        }else{        
            $request->validate([
                'share_no' => 'required|string',
            ]);    
            $share_no = $request->share_no;
        }
        
        Society::create([
                'society_id' => session()->get('society_id'),
                'name' => session()->get('society_name'),
                'address' => session()->get('address'),
                'share_value' => session()->get('share_value'),
                'phone_no' => session()->get('phone_no'),
                'society_type' => session()->get('society_type'),
                'lending_interest_rate' => session()->get('lending_interest_rate'),
                'society_start' => session()->get('society_start'),
                'society_end' => session()->get('society_end'),
                'status' => 'yes'
            ]);

        $user = User::create([
            'society_id' => session()->get('society_id'),
            'name' => $request->name,
            'email' => $request->email,
            'user_name' => $request->user_name,
            'phone_no' => $request->phone_no,
            'address' => $request->address,
            'society_member' => $request->society_member,
            'share_no' => $share_no,
            'status' => 'yes',
            'password' => Hash::make($request->password),
        ]);

        $user->attachRole('admin');
        //$user->attachRole($request->role_id);
        
        //event(new Registered($user));

        //Auth::login($user);

        //return redirect(RouteServiceProvider::HOME);
        session()->flush();
        $request->session()->regenerate();
        return redirect('/login')
        ->with('message', 'Society Has been Registered')
        ->with('message_2', 'User Name : ' . $request->user_name)
        ->with('message_3', 'Password : ' . $request->password);
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