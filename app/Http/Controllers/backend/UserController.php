<?php

namespace App\Http\Controllers\backend;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Repository\UserRepository;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    protected $users;
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->users->index();
        return view('backend.pages.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('backend.pages.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $this->users->store($request);
        alert()->success('User Created Success');
        return to_route('backend.user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = $this->users->find($id);
        return view('backend.pages.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('backend.pages.user.edit', [
            'user' => User::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request,  $id)
    {
        $user = $this->users->find($id);
        $this->users->update($request, $user);
        alert()->success('User Updated Success');
        return to_route('backend.user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = $this->users->find($id)->delete();
        alert()->success('User Deleted Success');
        return to_route('backend.user.index');
    }
}