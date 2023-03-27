<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    /**
     * Show register account
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('/users/register');
    }

    /**
     * Handle account registration request
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        // validate
        $rules = array(
            'name'                   => 'required',
            'email'                  => ['required', 'email', Rule::unique('users', 'email')],
            'password'               => ['required', 'confirmed', 'min:3'],
            'password_confirmation'  => 'required'
        );
        $formFields = $request->validate($rules);

        $formFields['password'] = bcrypt($formFields['password']);

        $user = User::create($formFields);

        auth()->login($user);

        return redirect('/')->with('message', "Account successfully registered.");
    }

    /**
     * Handling logout request
     *
     * @return Response
     */

    public function logout()
    {
        auth()->logout();

        Session::flush();
        Session::invalidate();
        Session::regenerateToken();

        return redirect('login')->with('message', "You have been logout.");
    }

    /**
     * Show login account
     *
     * @param RegisterRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('/users/login');
    }

    /**
     * Handle an authentication attempt.
     */
    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/')->with('message', "login successfully.");;
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
