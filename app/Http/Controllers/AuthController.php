<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

/**
 * Class AuthController
 * @package App\Http\Controllers
 */
class AuthController extends Controller
{
    /**
     * Display registration form
     *
     * @return Factory|View
     */
    public function registerForm()
    {
        return view('pages.register');
    }

    /**
     * Registration action
     *
     * @param Request $request
     * @return RedirectResponse|Redirector
     * @throws ValidationException
     */
    public function register(Request $request)
    {
        $validated = $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $user = User::add($validated);
        $user->generatePassword($request->get('password'));

        return redirect()
            ->route('login')
            ->with('success', __('You have successfully registered and you can now enter the site'));

    }

    /**
     * Display login form
     *
     * @return Factory|View
     */
    public function loginForm()
    {
        return view('pages.login');
    }

    /**
     * Login action
     *
     * @param Request $request
     * @return RedirectResponse|Redirector
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt([
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ])) {
            return redirect()->route('home');
        }

        return redirect()->back()->with('status', __('Incorrect login or password'));
    }

    /**
     * Logout action
     *
     * @return RedirectResponse|Redirector
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
