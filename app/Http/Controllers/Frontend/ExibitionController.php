<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Exibition;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ExibitionSubmittion;
use App\Http\Controllers\Controller;

class ExibitionController extends Controller
{
    public function index()
    {
        $Exibitions = Exibition::all();
        return view('backend.pages.frontend.exibition.submittion.index', compact('Exibitions'));
    }
    public function show($id)
    {
        $Exibitions = Exibition::all();
        $Exibition = Exibition::with('exibitionSubmittion')->find($id);
        return view('backend.pages.frontend.exibition.submittion.show', compact('Exibition', 'Exibitions'));
    }
    public function submit($id)
    {
        $Exibitions = Exibition::all();
        $Exibition = Exibition::with('exibitionSubmittion')->find($id);
        return view('backend.pages.frontend.exibition.submittion.submit', compact('Exibition', 'Exibitions'));
    }
    public function submittion(Request $request, $id)
    {
        // dd($request->all());
        $Exibition = Exibition::with('exibitionSubmittion')->find($id);
        $request->validate([
            'artist_name' => 'required|string|max:255',
            'artwork_title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);
        $image_name = null;
        if ($request->hasFile('image')) {
            $image_name = date('Ymdhsis') . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('/uploads/exibition_images', $image_name);
        }
        $artwork = new ExibitionSubmittion();
        $artwork->exibition_id = $Exibition->id;
        $artwork->artist_name = $request['artist_name'];
        $artwork->artwork_number = 'ART-' . date('Ymdhsis') . '-' . Str::random(8);
        $artwork->artwork_title = $request['artwork_title'];
        $artwork->description = $request['description'];
        $artwork->image = $image_name;
        $artwork->save();
        return to_route('root');
    }
}