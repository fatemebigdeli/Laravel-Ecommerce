<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $categories= Category::latest()->paginate(20);
        return view('admin.categories.index', compact('categories'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parentCategories= Category::where('parent_id',0)->get();
        $attributes = Attribute::all();

        return view('admin.categories.create', compact('parentCategories', 'attributes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug',
            'parent_id' => 'required',
            'attribute_ids' => 'required',
            'attribute_ids.*' => 'exists:attributes,id',
            'attribute_is_filter_ids' => 'required',
            'attribute_is_filter_ids.*' => 'exists:attributes,id',
            'variation_id' => 'required|exists:attributes,id',
        ]);


       try {
            DB::beginTransaction();
            $category =Category::create([
                'name' => $request->name,
                'slug' => $request->slug,
                'parent_id' =>$request->parent_id,
                'icon' => $request->icon,
                'description' => $request->description,
            ]);

            foreach($request->attribute_ids as $attributeId)
            {
                $attribute =Attribute::findOrFail($attributeId);
                $attribute->categories()->attach($category->id , [
                    'is_filter' => in_array($attributeId,$request->attribute_is_filter_ids) ? 1:0,
                    'is_variation'=>$request->variation_id == $attributeId ? 1:0
                    ] );
            }
            DB::commit();


        } catch (\Exception $exception) {
                DB::rollBack();
                Alert::error('مشکل در ایجاد دسته بندی', $exception->getMessage());
                return redirect()->back();
        }


        Alert::success('با تشکر', 'دسته‌بندی مورد نظر ایجاد شد.')->persistent(true,true);
            return redirect()->route('admin.categories.index');
    }



    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('admin.categories.show' , compact('category'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $attributes = Attribute::all();
        $parentCategories= Category::where('parent_id',0)->get();
        return view('admin.categories.edit' , compact('attributes','category','parentCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {

        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,'.$category->id ,
            'parent_id' => 'required',
            'attribute_ids' => 'required',
            'attribute_ids.*' => 'exists:attributes,id',
            'attribute_is_filter_ids' => 'required',
            'attribute_is_filter_ids.*' => 'exists:attributes,id',
            'variation_id' => 'required|exists:attributes,id',
        ]);


       try {
            DB::beginTransaction();
            $category->update([
                'name' => $request->name,
                'slug' => $request->slug,
                'parent_id' =>$request->parent_id,
                'icon' => $request->icon,
                'description' => $request->description,
            ]);

            $category->attributes()->detach();

            foreach($request->attribute_ids as $attributeId)
            {
                $attribute =Attribute::findOrFail($attributeId);
                $attribute->categories()->attach($category->id , [
                    'is_filter' => in_array($attributeId,$request->attribute_is_filter_ids) ? 1:0,
                    'is_variation'=>$request->variation_id == $attributeId ? 1:0
                    ] );
            }
            DB::commit();


        } catch (\Exception $exception) {
                DB::rollBack();
                Alert::error('مشکل در ویرایش دسته بندی', $exception->getMessage());
                return redirect()->back();
        }


        Alert::success('با تشکر', 'دسته‌بندی مورد نظر ویرایش شد.')->persistent(true,true);
            return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getCategoryAttributes(Category $category) {
        $attributes =$category->attributes()->wherePivot('is_variation',0)->get();
        $variation =$category->attributes()->wherePivot('is_variation',1)->first();

        return ['attributes' => $attributes , 'variation' => $variation];
    }

}
