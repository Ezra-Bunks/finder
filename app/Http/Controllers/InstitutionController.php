<?php

namespace App\Http\Controllers;

use App\Models\Institution;
use Illuminate\Http\Request;

class InstitutionController extends Controller
{
    public function index()
    {
        $institutions = Institution::orderBy('name')->get();
        return view('institution.select', compact('institutions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'institution_id' => 'required|exists:institutions,id',
        ]);

        session(['institution_id' => $request->institution_id]);

        if (auth()->check()) {
            auth()->user()->update(['institution_id' => $request->institution_id]);
        }

        return redirect()->route('home');
    }
}