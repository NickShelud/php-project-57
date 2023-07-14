<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $labels = Label::paginate(15);

        return view('label.index', compact('labels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user() === null) {
            abort(403);
        }

        $label = new Label();

        return view('label.create', compact('label'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user() === null) {
            abort(403);
        }
        $data = $this->validate($request, [
            'name' => 'required|unique:labels,name',
            'description' => 'nullable'
        ]);

        flash(__('trans.flash.labelCreate'))->success();

        $label = new Label();
        $label->fill($data);
        $label->save();

        return redirect()->route('labels.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Label $label)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Label $label)
    {
        if (Auth::user() === null) {
            abort(403);
        }
        return view('label.edit', compact('label'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Label $label)
    {
        if (Auth::user() === null) {
            abort(403);
        }
        $data = $this->validate($request, [
            'name' => 'required|unique:labels,name',
            'description' => 'nullable'
        ]);

        flash(__('trans.flash.labelUpdate'))->success();

        $label->fill($data);
        $label->save();

        return redirect()->route('labels.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Label $label)
    {
        if (Auth::user() === null) {
            abort(403);
        }
        $task = Tasks::where('label_id', $label->id)->exists();

        if ($label->tasks()->exists()) {
            flash(__('trans.flash.labelNotDelete'))->error();
            return back();
        }

        
        $label->delete();
        flash(__('trans.flash.labelDelete'))->success();

        return redirect()->route('labels.index');
    }
}
