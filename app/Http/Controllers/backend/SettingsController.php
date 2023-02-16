<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    public function index(){
        return view('backend.pages.settings.settings');
    }
    public function update(Request $request){
        $validate= Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'address'=>'required',
            'logo'=>'required',
            'favicon'=>'required',
            'linkedin'=>'required',
            'facebook'=>'required',
        ]);
        if($validate->fails()){
            return redirect()->back()->withErrors($validate)->withInput();
        }
        $logo = settings()->logo;
        if ($request->hasFile('logo')) {
            $image_name = date('Ymdhsis').'.'.$request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->storeAs('/uploads/settings', $logo);
        }
        $favicon = settings()->favicon;
        if ($request->hasFile('favicon')) {
            $image_name = date('Ymdhsis').'.'.$request->file('favicon')->getClientOriginalExtension();
            $request->file('favicon')->storeAs('/uploads/settings', $favicon);
        }
        settings()->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'logo'=>$logo,
            'favicon'=>$favicon,
            'linkedin'=>$request->linkedin,
            'facebook'=>$request->facebook,
        ]);
        return to_route('backend.settings.index');
    }
}