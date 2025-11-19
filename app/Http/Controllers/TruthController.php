<?php

namespace App\Http\Controllers;

use App\Models\Truth;
use Illuminate\Http\Request;

class TruthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string',
            'category_type' => 'nullable|string'
        ]);

        Truth::create([
            'question' => $request->question,
            'type' => $request->category_type,
        ]);

        return response()->json(['success' => true, 'message' => 'Truth saved successfully']);
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
        $truth = Truth::findOrFail($id);
        return response()->json([
            'id' => $truth->id,
            'question' => $truth->question,
            'type' => $truth->type, // or 'type' field in DB
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'question' => 'required|string',
            'category_type' => 'nullable|string'
        ]);

        $truth = Truth::findOrFail($id);

        $truth->update([
            'question' => $request->question,
            'type' => $request->category_type,
        ]);

        return response()->json(['success' => true, 'message' => 'Truth updated successfully', 'id' => $truth->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $truth = Truth::findOrFail($id);
        $truth->delete();

        return response()->json(['success' => true, 'message' => 'Truth deleted successfully']);
    }
}
