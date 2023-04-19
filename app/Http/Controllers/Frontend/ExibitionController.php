<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Exibition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExibitionController extends Controller
{
    public function index()
    {
        $Exibitions = Exibition::all();
        return view('backend.pages.frontend.exibition.submittion.create', compact('Exibitions'));
    }
}