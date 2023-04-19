<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
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
        $roles = Role::orderBy('id', 'DESC')->take(2)->get();
        return view('auth.registration', compact('roles'));
    }
    public function registration(StoreUserRequest $request)
    {
        try {
            $image_name = null;
            if ($request->hasFile('image')) {
                $image_name = date('Ymdhsis') . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->storeAs('/uploads/users', $image_name);
            }
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'role_id' => $request->role_id,
                'username' => Str::slug($request->name) . date('Ymdhsis'),
                'status' => $request->status ? $request->status : 1,
                'dob' => $request->dob,
                'address' => $request->address,
                'password' => bcrypt($request->password),
                'image' => $image_name,
            ]);
            alert()->success('User Created Success');
        } catch (\Throwable $th) {
            alert()->error($th->getMessage());
        }
        return to_route('backend.auth.login');
    }
}