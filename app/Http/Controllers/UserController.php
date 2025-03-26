<?php

namespace App\Http\Controllers;

use App\Service\user\UserService;
use Illuminate\Routing\Controller;

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




}
