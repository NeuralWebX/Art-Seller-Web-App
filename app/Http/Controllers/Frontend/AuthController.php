<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Repository\UserRepository;
use App\Http\Requests\StoreUserRequest;

class AuthController extends Controller
{
    protected $users;
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }
    public function regForm()
    {
        return view('auth.registration');
    }
    public function registration(StoreUserRequest $request)
    {
        $this->users->store($request);
        alert()->success('User Created Success');
        return to_route('backend.auth.login');
    }
}
