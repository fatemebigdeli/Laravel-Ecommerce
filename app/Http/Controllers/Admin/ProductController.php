<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ProductAttribute;
use App\Models\ProductVariation;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Admin\ProductAttributeController;
use App\Http\Controllers\Admin\ProductVariationController;
use App\Models\Product;
use App\Models\ProductImage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->paginate(20);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::all();
        $tags = Tag::all();
        $categories = Category::where('parent_id', '!=', 0)->get();

        return view('admin.products.create', compact('brands', 'tags', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'brand_id' => 'required',
            'is_active' => 'required',
            'tag_ids' => 'required',
            'description' => 'required',
            'primary_image' => 'required|mimes:jpg,jpeg,png,svg',
            'images' => 'required',
            'images.*' => 'mimes:jpg,jpeg,png,svg',
            'category_id' => 'required',
            'attribute_ids' => 'required',
            'attribute_ids.*' => 'required',
            'variation_values' => 'required',
            'variation_values.*.*' => 'required',
            'variation_values.price.*' => 'integer',
            'variation_values.quantity.*' => 'integer',
            'delivery_amount' => 'required|integer',
            'delivery_amount_per_product' => 'nullable|integer',
        ]);

        try {
            DB::beginTransaction();

            $ProductImageController = new ProductImageController();
            $fileNameImages = $ProductImageController->upload($request->primary_image, $request->images);

            $product = Product::create([
                'name' => $request->name,
                'brand_id' => $request->brand_id,
                'category_id' => $request->category_id,
                'primary_image' => $fileNameImages['fileNamePrimaryImage'],
                'description' => $request->description,
                'is_active' => $request->is_active,
                'delivery_amount' => $request->delivery_amount,
                'delivery_amount_per_product' => $request->delivery_amount_per_product,
            ]);

            foreach ($fileNameImages['fileNameImages'] as $fileNameImage) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $fileNameImage,
                ]);
            }

            $productAttributeController = new ProductAttributeController();
            $productAttributeController->store($request->attribute_ids, $product);

            $category = Category::find($request->category_id);
            $productVariationController = new ProductVariationController();
            $productVariationController->store($request->variation_values, $category->attributes()->wherePivot('is_variation', 1)->first()->id, $product);

            $product->tags()->attach($request->tag_ids);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            Alert::error('مشکل در ایجاد  محصول', $exception->getMessage());
            return redirect()->back();
        }

        Alert::success('با تشکر', 'محصول مورد نظر ایجاد شد.')->persistent(true, true);
        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $productAttributes = $product->attributes()->with('attribute')->get();
        $productVariations = $product->variations;
        $images = $product->images;
        return view('admin.products.show', compact('product', 'productAttributes', 'productVariations', 'images'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $brands = Brand::all();
        $tags = Tag::all();
        $productVariations = $product->variations;
        $productAttributes = $product->attributes()->with('attribute')->get();
        return view('admin.products.edit', compact('productVariations', 'productAttributes', 'product', 'brands', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'brand_id' => 'required|exists:brands,id',
            'is_active' => 'required',
            'tag_ids' => 'required',
            'tag_ids.*' => 'exists:tags,id',
            'description' => 'required',
            'attribute_values' => 'required',
            'variation_values' => 'required',
            'variation_values.*.price' => 'required|integer',
            'variation_values.*.quantity' => 'required|integer',
            'variation_values.*.sku' => 'required|integer',
            'variation_values.*.sale_price' => 'nullable|integer',
            'variation_values.*.date_on_sale_from' => 'nullable|date',
            'variation_values.*.date_on_sale_to' => 'nullable|date',
            'delivery_amount' => 'required|integer',
            'delivery_amount_per_product' => 'nullable|integer',
        ]);

        try {
            DB::beginTransaction();

            $product->update([
                'name' => $request->name,
                'brand_id' => $request->brand_id,
                'description' => $request->description,
                'is_active' => $request->is_active,
                'delivery_amount' => $request->delivery_amount,
                'delivery_amount_per_product' => $request->delivery_amount_per_product,
            ]);

            $productAttributeController = new ProductAttributeController();
            $productAttributeController->update($request->attribute_values);


            $productVariationController = new ProductVariationController();
            $productVariationController->update($request->variation_values);

            $product->tags()->sync($request->tag_ids);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            Alert::error('مشکل در ویرایش  محصول', $exception->getMessage());
            return redirect()->back();
        }

        Alert::success('با تشکر', 'محصول مورد نظر ویرایش شد.')->persistent(true, true);
        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    }

    public function editCategory(Request $request,Product $product)
    {

        $categories = Category::where('parent_id', '!=', 0)->get();
        return view('admin.products.edit_category',compact('product','categories'));
    }
    public function updateCategory(Request $request,Product $product){

        // dd($request->all());
        $request->validate([
            'category_id' => 'required',
            'attribute_ids' => 'required',
            'attribute_ids.*' => 'required',
            'variation_values' => 'required',
            'variation_values.*.*' => 'required',
            'variation_values.price.*' => 'integer',
            'variation_values.quantity.*' => 'integer',
        ]);

        try {
            DB::beginTransaction();

            $product->update([
                'category_id' => $request->category_id,
            ]);


            $productAttributeController = new ProductAttributeController();
            $productAttributeController->change($request->attribute_ids, $product);

            $category = Category::find($request->category_id);
            $productVariationController = new ProductVariationController();
            $productVariationController->change($request->variation_values, $category->attributes()->wherePivot('is_variation', 1)->first()->id, $product);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            Alert::error('مشکل در ایجاد  محصول', $exception->getMessage());
            return redirect()->back();
        }

        Alert::success('با تشکر', 'محصول مورد نظر ایجاد شد.')->persistent(true, true);
        return redirect()->route('admin.products.index');
    }
}
