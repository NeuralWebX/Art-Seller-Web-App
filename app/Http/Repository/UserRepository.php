<?php

namespace App\Http\Repository;

use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserRepository
{
    public function index()
    {
        $users = User::orderBy('updated_at', 'DESC')->get();
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
            'username' => Str::slug($request->name) . date('Ymdhsis'),
            'status' => $request->status ? $request->status : null,
            'dob' => $request->dob,
            'address' => $request->address,
            'password' => $request->password ? bcrypt($request->password) : bcrypt('162356'),
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