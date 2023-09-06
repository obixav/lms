<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\Setting;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;


class ProductService
{

    public function viewProductcategories()
    {
        $productCategories = ProductCategory::all();

        return view('admin.product_categories.index', compact('productCategories'));
    }
    public function saveProductCategory($request)
    {
        $pc = ProductCategory::updateOrCreate(
            ['id' => $request->input('id')],
            ['name' => $request->input('name')]
        );
        return response()->json(['success'=>true,'message' => 'Changes Saved Successfully'], 200);
    }
    public function viewProducts($request)
    {

        $products = Product::where('id', '<>', 0);
        if ($request->filled('q')) {
            $q = $request->input('q');

            $products->where(function ($query) use ($q) {
                $query->where('name', 'like', '%' . $q . '%')
                    ->orWhereHas('category', function ($query) use ($q) {
                        $query->where('product_categories.name', 'like', '%' . $q . '%');
                    })
                    ->orWhereHas('tags', function ($query) use ($q) {
                        $query->where('tags.name', 'like', '%' . $q . '%');
                    })
                    ->orWhere('sku', $q);
            });
        }
        if ($request->filled('category') && $request->category!=0) {
            $category_id = $request->input('category');

            $products->where('product_category_id',$category_id);
        }
        if ($request->filled('availability') && $request->availability!='') {
            $avaiable = $request->input('avaiable');

            $products->where('available',$avaiable);
        }
        if ($request->filled('featured') && $request->featured!='') {
            $featured = $request->input('featured');

            $products->where('is_featured',$featured);
        }
        $products=  $products->paginate(10);
        $productCategories=ProductCategory::all();
        return view('admin.products.index', compact('products','productCategories'));
    }

    public function editProduct($product_id)
    {
        $productCategories=ProductCategory::all();
         $product=Product::findOrFail($product_id);
        return view('admin.products.edit',compact('product','productCategories'));

    }

    public function deleteProduct($product_id)
    {
        $product=Product::where('id',$product_id)->doesntHave('orderLines')->firstOrFail();
        $product->delete();
        return response()->json(['success'=>true,'message' => 'Changes Saved Successfully'], 200);
    }
    public function saveProduct($request)
    {

        $product = Product::updateOrCreate(['id'=>$request->id],[
            'product_category_id' => $request->input('product_category_id'),
            'name' => $request->input('name'), 'price' => $request->input('price'),
            'available' => $request->input('available'), 'description' => $request->input('description'),
            'information' => $request->input('information'),
            'vendor_information' => $request->input('vendor_information'),
            'discount' => $request->input('discount'), 'is_featured' => $request->input('is_featured'),

        ]);
        if($request->filled('tags'))
        {
            foreach($request->input('tags') as $t)
            {
                $tag=Tag::firstOrCreate(['name'=>$t]);
                $product->tags()->attach($tag->id);
            }
        }
        if ($request->filled('product_images')) {
            foreach ($request->input('product_images', []) as $file) {
                $product->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('product_images');
            }
        }
        return response()->json(['success'=>true,'message' => 'Product Saved Successfully'], 200);
    }


    public function uploadProductImages($request)
    {
        $product = Product::findOrFail($request->id);
        if ($request->hasFile('product_images')) {
            foreach ($request->file('product_images') as $file) {
                $path = $file->store('product_images');
                $product->images()->create([
                    'file' => $path
                ]);
            }
        }
        return response()->json(['success'=>true,'message' => 'Images added Successfully'], 200);
    }

    public function updateProduct($request)
    {
        $product = Product::findOrFail($request->id);
        $product->update([
            'product_category_id' => $request->input('product_category_id'),
            'name' => $request->input('name'), 'price' => $request->input('price'),
            'available' => $request->input('available'), 'description' => $request->input('description'),
            'information' => $request->input('information'),
            'vendor_information' => $request->input('vendor_information'),
            'discount' => $request->input('discount'), 'is_featured' => $request->input('is_featured')
        ]);
        if (count($product->getMedia('*')) > 0) {
            foreach ($product->getMedia('*') as $media) {
                if (!in_array($media->file_name, $request->input('product_images', []))) {
                    $media->delete();
                }
            }
        }

        $media = $product->getMedia('*')->pluck('file_name')->toArray();

        foreach ($request->input('product_images', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $product->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('product_images');
            }
        }

        return response()->json(['success'=>true,'message' => 'Products updated Successfully'], 200);
    }

    public function deleteProductImage($request)
    {
        $image = ProductImage::findOrFail($request->id);
        Storage::delete($image->file);
        $image->delete();
        return response()->json(['message' => 'Image removed successfully'], 200);
    }
    public function searchForProduct($request,$category=0)
    {
        $product = (new Product)->newQuery();
        if($category>0)
        {
            $product->where('product_category_id',$category);
        }

        $product=$this->filter($request,$product);
        $view='products.card_view';

        if($request->filled('view') && $request->view=='list')
        {
            $view='products.list_view';
        }
        $product->get();
        $categories=ProductCategory::withCount('products')->get();

        return view($view,compact('product','categories'));
    }

    public function filter($request,$product)
    {


        if($request->filled('q'))
        {
            $q = $request->input('q');

            $product->where(function ($query) use ($q) {
                $query->where('name', 'like', '%' . $q . '%')
                    ->orWhereHas('product_category', function ($query) use ($q) {
                        $query->where('product_categories.name', 'like', '%' . $q . '%');
                    })
                    ->orWhereHas('tags', function ($query) use ($q) {
                        $query->where('tags.name', 'like', '%' . $q . '%');
                    })
                    ->orWhere('sku', $q);
            });

        }

        if($request->filled('sort'))
        {
            if($request->sort=='newness')
            {
                $product->orderByDesc('created_at');
            }elseif($request->sort=='oldness')
            {
                $product->orderBy('created_at');
            }elseif($request->sort=='high_price')
            {
                $product->orderByDesc('price');
            }elseif($request->sort=='low_price')
            {
                $product->orderBy('price');
            }
        }

        if($request->filled('price_range'))
        {
            $product->whereBetween('price',[$request->min_price,$request->max_price]);
        }

        return $product;
    }

    public function publicFilter($request,$products)
    {
        if($request->filled('q'))
        {
            $q = $request->input('q');

            $products->where(function ($query) use ($q) {
                $query->where('name', 'like', '%' . $q . '%')
                    ->orWhereHas('product_category', function ($query) use ($q) {
                        $query->where('product_categories.name', 'like', '%' . $q . '%');
                    })
                    ->orWhereHas('tags', function ($query) use ($q) {
                        $query->where('tags.name', 'like', '%' . $q . '%');
                    })
                    ->orWhere('sku', $q);
            });

        }
        if ($request->filled('category') && $request->category!=0) {
            $category_id = $request->input('category');

            $products->where('product_category_id',$category_id);
        }

        if($request->filled('sortby'))
        {
            if($request->sortby=='date-desc')
            {
                $products->orderByDesc('created_at');
            }elseif($request->sortby=='date-asc')
            {
                $products->orderBy('created_at');
            }elseif($request->sortby=='price-desc')
            {
                $products->orderByDesc('price');
            }elseif($request->sortby=='price-asc')
            {
                $products->orderBy('price');
            }
        }

        if($request->filled('min_price') && $request->filled('min_price'))
        {
            $products->whereBetween('price',[$request->min_price,$request->max_price]);
        }

        return $products;

    }

}
