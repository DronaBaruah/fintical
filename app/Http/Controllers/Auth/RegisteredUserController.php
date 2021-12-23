<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\Society;

class RegisteredUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function members()
    {
        $users = User::where([['society_id', Auth::user()->society_id], ['society_member', 'yes'], ['status', 'yes']])->with('loan', function($query) 
        {$query->where([['status', 'yes']])->sum('amount');})->with('disburse', function($query1) 
        {$query1->where([['status', 'yes']])->sum('amount');})->get();
      
        return view('members.members', compact('users'))
                ->with('society_data', Society::where('society_id', Auth::user()->society_id)->first());
    }
    
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        if(Auth::user()->hasRole('admin'))
        {
                return view('auth.member_register')
                ->with('society_data', Society::where('society_id', Auth::user()->society_id)->first())
                ->with('users', User::where([['society_id', Auth::user()->society_id], ['society_member', 'yes'], ['status', 'yes']])->orderBy('updated_at', 'DESC')->get());
        }
        else
        {
            return redirect('/dashboard')
            ->with('access_denied', 'Access Denied');
        }
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        if(Auth::user()->hasRole('admin'))
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'user_name' => 'required|string|max:255|unique:users',
                'phone_no' => 'required|string|max:10',
                'address' => 'required|string',
                'share_no' => 'required|string',
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
            
            $user = User::create([
                'society_id' => Auth::user()->society_id,
                'name' => $request->name,
                'email' => $request->email,
                'user_name' => $request->user_name,
                'phone_no' => $request->phone_no,
                'address' => $request->address,
                'society_member' => 'yes',
                'share_no' => $request->share_no,
                'status' => 'yes',
                'password' => Hash::make($request->password),
            ]);

            $user->attachRole('member');
            //$user->attachRole($request->role_id);
           
            //event(new Registered($user));

            //Auth::login($user);

            //return redirect(RouteServiceProvider::HOME);
            $request->session()->regenerate();
            return redirect('/member_register')
            ->with('message', 'Member Has been Added');
        }
    }

    public function show($id)
    {
        if(Auth::user()->hasRole('admin'))
            {
            $users = User::where([['id', $id], ['society_id', Auth::user()->society_id], ['society_member', 'yes'], ['status', 'yes']])->first();

            if($users == null)
            {
                return redirect('/members')
                ->with('access_denied', 'Access Denied');
            }
        
            return view('members.show')
                ->with('society_data', Society::where('society_id', Auth::user()->society_id)->first())
                ->with('user', User::where([['society_id', Auth::user()->society_id], ['id', $id], ['society_member', 'yes'], ['status', 'yes']])->first())
                ->with('roles', User::find($id)->roles->toArray());
        }
        else
        {
            return redirect('/members')
            ->with('access_denied', 'Access Denied');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->hasRole('admin'))
            {
                $users = User::where([['id', $id], ['society_id', Auth::user()->society_id], ['society_member', 'yes'], ['status', 'yes']])->first();

                if($users == null)
                {
                    return redirect('/404');
                }

                return view('members.edit')
                ->with('society_data', Society::where('society_id', Auth::user()->society_id)->first())
                ->with('user', User::where([['society_id', Auth::user()->society_id], ['id', $id], ['society_member', 'yes']])->first())
                ->with('roles', User::find($id)->roles->toArray());
            }
        else
            {
                return redirect('/dashboard')
                ->with('access_denied', 'Access Denied');
            }
    }

    public function update(Request $request, $id)
    {
        if(Auth::user()->hasRole('admin'))
            {
                $users = User::where([['id', $id], ['society_id', Auth::user()->society_id], ['society_member', 'yes'], ['status', 'yes']])->first();

                if($users == null)
                {
                    return redirect('/404');
                }

                $request->validate([
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users,email,' .$id ,
                    'phone_no' => 'required|string|max:10',
                    'address' => 'required|string',
                    'share_no' => 'required|string',
                    'password' => ['required', 'confirmed', Rules\Password::defaults()],
                ]);
                

                $user = User::where('id', $id)->update([
                    'society_id' => Auth::user()->society_id,
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone_no' => $request->phone_no,
                    'address' => $request->address,
                    'society_member' => 'yes',
                    'share_no' => $request->share_no,
                    'status' => 'yes',
                    'password' => Hash::make($request->password),
                ]);
                $users->roles()->detach();
                $users->attachRole($request->role_id);

                $request->session()->regenerate();
                return redirect('/members')
                    ->with('message', 'Member Has been Updated');
            }
    }

    public function delete_update(Request $request, $id)
    {
        if(Auth::user()->hasRole('admin'))
            {
                $users = User::where([['id', $id], ['society_id', Auth::user()->society_id], ['society_member', 'yes'], ['status', 'yes']])->first();

                if($users== null)
                {
                    return redirect('/404');
                }
                
                if(Auth::user()->id != $id)
                {
                    $user = User::where('id', $id)->update([
                        'status' => 'no',
                    ]);
                }   
                return redirect('/members')
                    ->with('message', 'Member Has been Deleted');
            }
    }

    // public function destroy($id)
    // {
    //     if(Auth::user()->hasRole('admin'))
    //     {
    //         $users = User::where([['id', $id], ['society_id', Auth::user()->society_id]])->first();

    //         if($users== null)
    //         {
    //             return redirect('/404');
    //         }
                    
    //         $users->delete();

    //         return redirect('/members')
    //                 ->with('message', 'Member Has been Deleted');
    //     }
    // }
}