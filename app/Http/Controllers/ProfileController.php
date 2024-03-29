<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

/**
 * Class ProfileController
 * @package App\Http\Controllers
 */
class ProfileController extends Controller
{
    /**
     * Display user's page
     *
     * @return Factory|View
     */
    public function index(): Factory|View
    {
        $user = Auth::user();
        return view('pages.profile', ['user' => $user]);
    }

    /**
     * Save user to database
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate(
            $request,
            [
            'name'  => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore(Auth::user()->id),
            ],
            'avatar' => 'nullable|image'
            ]
        );

        $user = Auth::user();
        if ($user) {
            /** @var User $user */
            $user->edit($request->all());
            $user->generatePassword($request->get('password'));
            $user->uploadAvatar($request->file('avatar'));
        }

        return redirect()->back()->with('status', 'Профиль успешно обновлен');
    }
}
