<?php

namespace App\Http\Controllers;

use App\Models\Dare;
use Illuminate\Http\Request;

class DareController extends Controller
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
            'dare' => 'required|string',
            'category_type' => 'nullable|string'
        ]);

        Dare::create([
            'dare' => $request->dare,
            'type' => $request->category_type,
        ]);

        return response()->json(['success' => true, 'message' => 'Dare saved successfully']);
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
        $dare = Dare::findOrFail($id);
        return response()->json([
            'id' => $dare->id,
            'dare' => $dare->dare,
            'type' => $dare->type,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'dare' => 'required|string',
            'category_type' => 'nullable|string'
        ]);

        $dare = Dare::findOrFail($id);

        $dare->update([
            'dare' => $request->dare,
            'type' => $request->category_type,
        ]);

        return response()->json(['success' => true, 'message' => 'Dare updated successfully', 'id' => $dare->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dare = Dare::findOrFail($id);
        $dare->delete();

        return response()->json(['success' => true, 'message' => 'Dare deleted successfully']); 
    }
}
