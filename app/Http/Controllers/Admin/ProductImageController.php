<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ProductImageController extends Controller
{
    public function upload($primary_image, $images)
    {
        $fileNameImagePrimary = generateFileName($primary_image->getClientOriginalName());
        $primary_image->move(public_path(env('PRODUCT_IMAGES_UPLOAD_PATH')), $fileNameImagePrimary);

        $fileNameImages = [];
        foreach ($images as $image) {
            $fileNameImage = generateFileName($image->getClientOriginalName());
            $image->move(public_path(env('PRODUCT_IMAGES_UPLOAD_PATH')), $fileNameImage);
            array_push($fileNameImages, $fileNameImage);
        }

        return ['fileNamePrimaryImage' => $fileNameImagePrimary, 'fileNameImages' => $fileNameImages];
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit_images', compact('product'));
    }
    public function destroy(Request $request)
    {
        $request->validate([
            'image_id' => 'required|exists:products_image,id',
        ]);

        ProductImage::destroy($request->image_id);
        Alert::success('با تشکر', 'تصویر محصول مورد نظر حذف شد.')->persistent(true, true);
        return redirect()->back();
    }
    public function setPrimary(Request $request, Product $product)
    {
        $request->validate([
            'image_id' => 'required|exists:products_image,id',
        ]);

        $productImage = ProductImage::findOrFail($request->image_id);

        $product->update([
            'primary_image' => $productImage->image,
        ]);
        Alert::success('با تشکر', 'ویرایش تصویر اصلی محصول با موفقیت انجام شد.')->persistent(true, true);

        return redirect()->back();
    }

    public function add(Request $request, Product $product)
    {
        $request->validate([
            'primary_image' => 'nullable|mimes:jpg,jpeg,png,svg',
            'images.*' => 'nullable|mimes:jpg,jpeg,png,svg',
        ]);

        if ($request->primary_image == null && $request->images == null) {
            return redirect()
                ->back()
                ->withErrors(['msg' => 'تصویر یا تصاویر محصول الزامی است.']);
        }

        try {
            DB::beginTransaction();
        if ($request->has('primary_image')) {
            $fileNameImagePrimary = generateFileName($request->primary_image->getClientOriginalName());
            $request->primary_image->move(public_path(env('PRODUCT_IMAGES_UPLOAD_PATH')), $fileNameImagePrimary);

            $product->update([
                'primary_image' => $fileNameImagePrimary,
            ]);
        }
        if ($request->has('images')) {
            foreach ($request->images as $image) {
                $fileNameImage = generateFileName($image->getClientOriginalName());
                $image->move(public_path(env('PRODUCT_IMAGES_UPLOAD_PATH')), $fileNameImage);

                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $fileNameImage,
                ]);
            }
        }
        DB::commit();
    } catch (\Exception $exception) {
        DB::rollBack();

        Alert::error('مشکل در ویرایش  تصویر', $exception->getMessage());
        return redirect()->back();
    }
        Alert::success('با تشکر', 'ویرایش تصویر اصلی محصول با موفقیت انجام شد.')->persistent(true, true);

        return redirect()->back();
    }
}
