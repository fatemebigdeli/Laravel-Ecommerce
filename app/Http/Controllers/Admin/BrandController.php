<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use RealRashid\SweetAlert\Facades\Alert;

use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands= Brand::latest()->paginate(20);
        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required'
        ]);


        Brand::create([
            'name'=> $request->name,
            'is_active' => $request->is_active,
        ]);
        Alert::success('با تشکر', 'برند مورد نظر ایجاد شد.')->persistent(true,true);

        return redirect()->route('admin.brands.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        return view('admin.brands.show' , compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('admin.brands.edit' , compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name'=> 'required'
        ]);


        $brand->update([
            'name'=> $request->name,
            'is_active' => $request->is_active,
        ]);
        Alert::success('با تشکر', 'برند مورد نظر ویرایش شد.')->persistent(true,true);

        return redirect()->route('admin.brands.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
