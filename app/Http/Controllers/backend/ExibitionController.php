<?php

namespace App\Http\Controllers\backend;

use App\Models\Exibition;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ExhibitionRequest;

class ExibitionController extends Controller
{
    public function index()
    {
        $Exibitions = Exibition::all();
        return view('backend.pages.exibition.list', compact('Exibitions'));
    }

    public function create()
    {
        $Exibition = new Exibition();
        return view('backend.pages.exibition.create', compact('Exibition'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1000'],
            'image' => ['required', 'image', 'max:2048'],
            'cover' => ['required', 'image', 'max:2048'],
            'location' => ['required', 'string', 'max:255'],
            'start_at' => ['required'],
            'end_at' => ['required', 'after_or_equal:start_at'],
        ]);
        $exibition = new Exibition();
        $exibition->name = $validatedData['name'];
        $exibition->description = $validatedData['description'];
        $exibition->location = $validatedData['location'];
        $exibition->start_at = $validatedData['start_at'];
        $exibition->end_at = $validatedData['end_at'];
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/exibition_images'), $filename);
            $exibition->image = $filename;
        }
        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $filename = time() . '_' . $cover->getClientOriginalName();
            $cover->move(public_path('uploads/exibition_covers'), $filename);
            $exibition->cover = $filename;
        }
        $exibition->save();
        return redirect()->route('backend.exibition.index');
    }

    public function show($Exibition)
    {
        $Exibition = Exibition::find($Exibition);
        return view('backend.pages.exibition.edit', compact('Exibition'));
    }

    public function edit($Exibition)
    {
        $Exibition = Exibition::find($Exibition);
        return view('backend.pages.exibition.edit', compact('Exibition'));
    }

    public function update(ExhibitionRequest $request, Exibition $Exibition)
    {
        $Exibition->update($request->validated());
        return redirect()->route('backend.exibition.index');
    }

    public function destroy($Exibition)
    {
        $Exibition = Exibition::find($Exibition);
        $Exibition->delete();
        return redirect()->route('backend.exibition.index');
    }
}
