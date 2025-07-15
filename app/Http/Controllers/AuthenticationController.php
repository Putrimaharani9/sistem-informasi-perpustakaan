<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use App\Models\UserDeviceId;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    /**
     * Login page
     */
    public function index()
    {
        $pageTitle = 'Login';
        return view('login.index', compact('pageTitle'));
    }

    /**
     * User login
     */
    public function authenticate(UserLoginRequest $request)
    {
        // Attempt login
        if (Auth()->attempt($request->only(['email', 'password']), $request->remember)) {
            $request->session()->regenerate();

            if ($request->device_id) {
                UserDeviceId::firstOrCreate([
                    'device_id' => $request->device_id,
                    'user_id' => Auth::user()->id,
                ]);
            }

            return redirect()->intended('dashboard');
        } else {
            // Login fails
            return back()->withErrors([
                'email' => 'Data yang Anda masukkan tidak tersedia pada sistem kami.',
            ])->onlyInput('email');
        }
    }

    /**
     * User logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        $request->session()->invalidate();
        $request->session()->regenerate();

        return redirect('/');
    }
}
