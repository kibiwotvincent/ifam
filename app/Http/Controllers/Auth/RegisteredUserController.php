<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
//use App\Providers\RouteServiceProvider;
//use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
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
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'id_number' => 'required|numeric|digits_between:7,8|unique:users',
            'phone_number' => 'required|string|numeric|digits:10|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

		//check if user has agreed to terms and conditions
		if($request->terms != "terms accepted") {
			return redirect()->back()->withInput()->with('error', "You need to agree to terms and conditions to register.");
		}

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'id_number' => $request->id_number,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
        ]);

        //event(new Registered($user));

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
