<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Update Member Details</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <style>
    @import url('https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.min.css');
    </style>

</head>

<body class="bg-gray-700">
    <div class="font-sans text-gray-900  antialiased">
        @include('layouts.sidebar')

        <div class="relative md:ml-64 bg-no-repeat bg-contain md:pt-5 pb-10"
            style="background-image: url(https://1.bp.blogspot.com/-9Y2Duj01GVo/YP6xJznqICI/AAAAAAAAHD4/_-XAKXZ6_0oJT4QSJ13UPTJL_Uj_wXZFwCLcBGAsYHQ/s0/register_bg_2.pn)">

            @include('layouts.navbar')
            <div class="px-1 md:px-0">
                <div class="bg-gray-100 text-center font-semibold text-xl w-full m-auto py-2 rounded-t border border-gray-300 mt-5"
                    style="max-width:1000px;">
                    {{ $society_data->name }}
                </div>
                <div class="bg-gray-100 mx-auto text-gray-500 rounded-b shadow-xl w-full overflow-hidden"
                    style="max-width:1000px">
                    <div class="text-center my-5">
                        <h1 class="font-semibold md:text-xl text-xl text-gray-900">UPDATE MEMBER DETAILS</h1>
                    </div>

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4 text-center" :errors="$errors" />
                    <form action="/members/{{ $user->id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="w-full md:grid lg:grid-cols-2 md:grid-cols-2 md:gap-2 md:px-10 px-2">
                            <div class="flex -mx-3">
                                <div class="w-full px-3 mb-5">
                                    <label for="" class="text-xs font-semibold px-1">
                                        Society Id</label>
                                    <div class="flex">
                                        <div
                                            class="w-10 z-0 pl-1 text-center pointer-events-none flex items-center justify-center">

                                        </div>
                                        <div
                                            class="w-full -ml-10 pl-3  pr-3 py-2 rounded-lg border-2 font-semibold text-gray-900 border-gray-200 outline-none bg-gray-100">
                                            {{ $society_data->society_id }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex -mx-3">
                                <div class="w-full px-3 mb-5">
                                    <label for="" class="text-xs font-semibold px-1">
                                        Society Name</label>
                                    <div class="flex">
                                        <div
                                            class="w-10 z-0 pl-1 text-center pointer-events-none flex items-center justify-center">
                                        </div>
                                        <div
                                            class="w-full -ml-10 pl-3 pr-3 py-2 rounded-lg border-2 font-semibold text-gray-900 border-gray-200 outline-none bg-gray-100">
                                            {{ $society_data->name }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full md:grid lg:grid-cols-2 md:grid-cols-2 md:gap-2 md:px-10 px-2">
                            <div class="flex -mx-3">
                                <div class="w-full px-3 mb-5">
                                    <label for="" class="text-xs font-semibold px-1">Full
                                        Name</label>
                                    <div class="flex">
                                        <div
                                            class="w-10 z-0 pl-1 text-center pointer-events-none flex items-center justify-center">
                                            <i class="mdi mdi-account-outline text-gray-400 text-lg"></i>
                                        </div>
                                        <input type="text" name="name" value="{{ $user->name }}"
                                            class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 font-semibold text-gray-900 border-gray-200 outline-none focus:border-indigo-500"
                                            required autofocus>
                                    </div>
                                </div>

                            </div>
                            <div class="flex -mx-3">
                                <div class="w-full px-3 mb-5">
                                    <label for="" class="text-xs font-semibold px-1">Address</label>
                                    <div class="flex">
                                        <div
                                            class="w-10 z-0 pl-1 text-center pointer-events-none flex items-center justify-center">
                                            <i class="mdi mdi-home-outline text-gray-400 text-lg"></i>
                                        </div>
                                        <input type="text" name="address" value="{{ $user->address }}"
                                            class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 font-semibold text-gray-900 border-gray-200 outline-none focus:border-indigo-500"
                                            required autofocus>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="w-full md:grid lg:grid-cols-2 md:grid-cols-2 md:gap-2 md:px-10 px-2">
                            <div class="flex -mx-3">
                                <div class="w-full px-3 mb-5">
                                    <label for="" class="text-xs font-semibold px-1">Email</label>
                                    <div class="flex">
                                        <div
                                            class="w-10 z-0 pl-1 text-center pointer-events-none flex items-center justify-center">
                                            <i class="mdi mdi-email-outline text-gray-400 text-lg"></i>
                                        </div>
                                        <input type="text" name="email" value="{{ $user->email }}"
                                            class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 font-semibold text-gray-900 border-gray-200 outline-none focus:border-indigo-500"
                                            required autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="flex -mx-3">
                                <div class="w-full px-3 mb-5">
                                    <label for="" class="text-xs font-semibold px-1">Phone No.</label>
                                    <div class="flex">
                                        <div
                                            class="w-10 z-0 pl-1 text-center pointer-events-none flex items-center justify-center">
                                            <i class="mdi mdi-phone-outline text-gray-400 text-lg"></i>
                                        </div>
                                        <input type="text" name="phone_no" value="{{ $user->phone_no }}"
                                            class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 font-semibold text-gray-900 border-gray-200 outline-none focus:border-indigo-500"
                                            required autofocus>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full md:grid lg:grid-cols-2 md:grid-cols-2 md:gap-2 md:px-10 px-2">
                            <div class="flex -mx-3">
                                <div class="w-full px-3 mb-5">
                                    <label for="" class="text-xs font-semibold px-1">No of Share</label>
                                    <div class="flex">
                                        <div
                                            class="w-10 z-0 pl-1 text-center pointer-events-none flex items-center justify-center">
                                            <i class="fas fa-coins text-gray-400 text-lg"></i>
                                        </div>
                                        <input type="text" name="share_no" value="{{ $user->share_no }}"
                                            class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 font-semibold text-gray-900 border-gray-200 outline-none focus:border-indigo-500"
                                            required autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="flex -mx-3">

                                <div class="w-full px-3 mb-5">
                                    <label for="" class="text-xs font-semibold px-1">User Name</label>
                                    <div class="flex">
                                        <div
                                            class="w-10 z-0 pl-1 text-center pointer-events-none flex items-center justify-center">
                                            <i class="mdi mdi-account-outline text-gray-400 text-lg"></i>
                                        </div>
                                        <div
                                            class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 font-semibold text-gray-900 border-gray-200 outline-none bg-gray-100">
                                            {{ $user->user_name }}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="w-full md:grid lg:grid-cols-2 md:grid-cols-2 md:gap-2 md:px-10 px-2">
                            <div class="flex -mx-3">
                                <div class="w-full px-3 mb-5">
                                    <label for="" class="text-xs font-semibold px-1">Password</label>
                                    <div class="flex">
                                        <div
                                            class="w-10 z-0 pl-1 text-center pointer-events-none flex items-center justify-center">
                                            <i class="mdi mdi-lock-outline text-gray-400 text-lg"></i>
                                        </div>
                                        <input type="password" name="password" placeholder="********"
                                            class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 font-semibold text-gray-900 border-gray-200 outline-none focus:border-indigo-500"
                                            required autocomplete="new-password" autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="flex -mx-3">
                                <div class="w-full px-3 mb-5">
                                    <label for="" class="text-xs font-semibold px-1">Confirm Password</label>
                                    <div class="flex">
                                        <div
                                            class="w-10 z-0 pl-1 text-center pointer-events-none flex items-center justify-center">
                                            <i class="mdi mdi-lock-outline text-gray-400 text-lg"></i>
                                        </div>
                                        <input type="password" name="password_confirmation" placeholder="********"
                                            class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 font-semibold text-gray-900 border-gray-200 outline-none focus:border-indigo-500"
                                            required autocomplete="new-password" autofocus>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full md:grid lg:grid-cols-2 md:grid-cols-2 md:gap-2 md:px-10 px-2">
                            <div class="flex -mx-3">
                                <div class="w-full px-3 mb-5">
                                    <label for="" class="text-xs font-semibold px-1">Register As</label>
                                    <div class="flex">
                                        <div
                                            class="w-10 z-0 pl-1 text-center pointer-events-none flex items-center justify-center">
                                            <i class="mdi mdi-account-outline text-gray-400 text-lg"></i>
                                        </div>
                                        <select name="role_id" id="role_id"
                                            class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 font-semibold text-gray-900 border-gray-200 outline-none focus:border-indigo-500">
                                            @foreach($user->roles as $role)
                                            <option value="{{ $role->name }}">{{ $role->display_name }}</option>
                                            @endforeach

                                            @if($user->id != Auth::user()->id)

                                            @if($role->name == "admin")
                                            <option value="member">Member</option>
                                            @else
                                            <option value="admin">Admin</option>
                                            @endif

                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (Auth::user()->hasRole('admin'))
                        <div class="w-full flex justify-center">
                            <div class="my-5">
                                <button type="submit"
                                    class="block mx-auto bg-indigo-500 hover:bg-indigo-700 focus:bg-indigo-700 text-white rounded-lg px-5 py-3 font-semibold uppercase">Update
                                    Member</button>
                            </div>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>