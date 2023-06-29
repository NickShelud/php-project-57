<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Model\Tasks;
use Illuminate\Http\Request;

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
        $label = new Label();

        return view('label.create', compact('label'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required',
            'description' => 'nullable'
        ]);

        if($data) {
            flash(__('trans.flash.labelCreate'))->success();
        } else {
            flash(__('trans.flash.labelNotCreate'))->error();
        }

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
        return view('label.edit', compact('label'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Label $label)
    {
        $data = $this->validate($request, [
            'name' => 'required',
            'description' => 'nullable'
        ]);

        $label = Label::findOrFail($label->id);

        if($data) {
            flash(__('trans.flash.labelUpdate'))->success();
        } else {
            flash(__('trans.flash.labelNotUpdate'))->error();
        }
        
        $label->fill($data);
        $label->save();

        return redirect()->route('labels.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Label $label)
    {
        $task = Tasks::where('label_id', $label->id)->first();

        if(!$task and $label) {
            $label->destroy();
            flash(__('trans.flash.labelDelete'))->success();
        } else {
            flash(__('trans.flash.labelNotDelete'))->success();
        }

        return redirect()->route('labels.index');
    }
}
