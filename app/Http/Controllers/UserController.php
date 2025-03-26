<?php

namespace App\Http\Controllers;

use App\Dto\UserDTO;
use App\Models\User;
use App\Service\user\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private UserService $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function showRegister(): Response
    {
        return response()->view('auth.register');
    }

    public function create(Request $request): RedirectResponse
    {
        $userDto = new UserDTO(
            $request->get('username'),
            $request->get('email'),
            $request->get('password')
        );
        $this->userService->create($userDto);
        return redirect()->route('register')->with("success", "Регистрация прошла успешно!");
    }

    public function showLogin(): Response
    {
        return response()->view('auth.login');
    }

    public function login(Request $request): User
    {
        return $this->userService->findByEmailAndPassword(
            $request->get('email'),
            $request->get('password')
        );
    }

    public function logout(): void
    {
        Auth::logout();
    }
}
