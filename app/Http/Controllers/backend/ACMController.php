<?php

namespace App\Http\Controllers\backend;

use App\Models\Role;
use App\Models\Module;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\RedirectResponse;

class ACMController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::orderBy('id','desc')->get();
        $permissions = Permission::all();
        return view('backend.pages.acm.index',compact('roles','permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $modules = Module::with('permissions')->get();
        return view('backend.pages.acm.create',compact('modules'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name'
        ]);
        try {
            $role =  Role::create([
                'name'=>$request->name,
                'slug'=> Str::slug($request->name),
            ]);
            $role->permissions()->sync($request->permission_ids);
            return redirect()->route('backend.role-permission.index');
        }catch (\Throwable $throwable){
            return redirect()->back()->withErrors($throwable->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::find($id);
        $modules = Module::with('permissions')->get();
        return view('backend.pages.acm.edit',compact('role','modules'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $id
        ]);
        $role = Role::where('id',$id)->first();
        if(!$role){
            return redirect()->back();
        }
        $role->update([
            'name'=>$request->name,
            'slug'=> Str::slug($request->name),
        ]);
        $role->permissions()->sync($request->permission_ids);
        return redirect()->route('backend.role-permission.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $role = Role::where('id',$id)->where('id', '!=', 1)->first();
            if(!$role){
                return redirect()->back();
            }
            $role->delete();
            return redirect()->back();

        }catch(\Throwable $throwable){
            if($throwable->getCode() == 23000){
           }
            return redirect()->back();
        }
    }
}