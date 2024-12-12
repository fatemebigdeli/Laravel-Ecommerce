<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $attributes= Attribute::latest()->paginate(20);
        return view('admin.attributes.index', compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.attributes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required'
        ]);


        Attribute::create([
            'name'=> $request->name,
        ]);
        Alert::success('با تشکر', 'ویژگی مورد نظر ایجاد شد.')->persistent(true,true);

        return redirect()->route('admin.attributes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Attribute $attribute)
    {
        return view('admin.attributes.show',compact('attribute'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attribute $attribute)
    {
        return view('admin.attributes.edit', compact('attribute'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Attribute $attribute)
    {
        $request->validate([
            'name'=> 'required'
        ]);


        $attribute->update([
            'name'=> $request->name,
        ]);
        Alert::success('با تشکر', 'ویژگی مورد نظر ویرایش شد.')->persistent(true,true);

        return redirect()->route('admin.attributes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
