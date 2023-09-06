<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Validation\Rules;

class CustomerLoginController extends Controller
{
    //

    public function showCustomerLoginForm()
    {
        return view('customer-auth.login', ['url' => route('customers.login-view'), 'title'=>'Customer']);
    }

    public function customerLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);



        if(auth()->guard('customer')->attempt(['email' => request('email'), 'password' => request('password')])){

            return redirect()->intended('/customers/dashboard');
        }else{
            return back()->with(['error' => ['Email and Password are Wrong.']], 200);
        }
    }

    /**
     * Display the registration view.
     */
    public function showCustomerRegisterForm(): View
    {
        return view('customer-auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::guard('customer')->login($user);

        return redirect(RouteServiceProvider::CUSTOMER_HOME);
    }
    public function logout(){
        Auth::guard('customer')->logout();
        return redirect()->route('customers.login-view');
    }
}
