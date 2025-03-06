<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $labels = Label::paginate(15);
        return view('labels.index', compact('labels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $label = new Label();
        return view('labels.create', compact('label'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:labels',
            'description' => 'nullable|string|max:1000',
        ], ['name.unique' => __('labels.already-exists')]);
        $label = new Label();
        $label->fill($data);
        $label->save();
        flash(__('labels.created-successfully'))->success();
        return redirect()->route('labels.index');
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
        $label = Label::findOrFail($id);
        return view('labels.edit', compact('label'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $label = Label::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|unique:labels,name,' . $label->id,
            'description' => 'nullable|string|max:1000',
        ], ['name.unique' => __('labels.already-exists')]);
        $label->fill($data);
        $label->save();
        flash(__('labels.changed-successfully'))->success();
        return redirect()->route('labels.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $label = Label::findOrFail($id);
        if ($label->tasks->count() == 0) {
            $label->delete();
            flash(__('labels.deleted-successfully'))->success();
        } else {
            flash(__('labels.deleted-fail-is-used'))->error();
        }
        return redirect()->route('labels.index');
    }
}
