<?php

namespace App\Http\Repository;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserRepository
{
    public function index()
    {
        $users = User::all();
        return $users;
    }
    public function find($id)
    {
        $user = User::find($id);
        return $user;
    }
    public function store(StoreUserRequest $request)
    {
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
            'username' => str_replace('', '_', $request->name),
            'status' => $request->status,
            'dob' => $request->dob,
            'address' => $request->address,
            'password' => bcrypt($request->password),
            'image' => $image_name,
        ]);
    }
    public function update(UpdateUserRequest $request, $user)
    {
        $image_name = $user->image;
        if ($request->hasFile('image')) {
            $image_name = date('Ymdhsis') . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('/uploads/users', $image_name);
        }
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role_id' => $request->role_id,
            'username' => str_replace('', '_', $request->name),
            'status' => $request->status,
            'dob' => $request->dob,
            'address' => $request->address,
            'password' => bcrypt($request->password),
            'image' => $image_name,
        ]);
    }
}
