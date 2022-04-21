<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("product.create")->with([
            'categories' => Category::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //validation
        $this->validate($request,[
            "title"=> "required|min:3",
            "description"=> "required|min:5",
            "image"=> "required|image|mimes:png,jpg,jpe|max:2048",
            "price"=> "required|numeric",
            "category_id"=> "required|numeric",
        ]);
        if($request->has("image")){
            $file = $request->image;
            $imageName = time()."_".$file->getClientOriginalName();
            $file->move(public_path("storage/images/products"),$imageName);
        }
        $title = $request->title;
        Product::create([
            "title" =>$title,
            "slug" => Str::slug($title),
            "description" =>$request->description,
            "price" =>$request->price,
            "old_price" =>$request->old_price,
            "inStock" =>$request->inStock,
            "category_id" =>$request->category_id,
            "image" =>$imageName,
        ]);
        return redirect()->route("dashboard")->with('success', "Product added successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //collect(Product::where("slug", $slug)->unique();)->unique('slug')->all();
        $product = Product::where("slug", $slug)->first();
        return view('product.show')->with([
            "products" => Product::where('id', "!=", $product->id)->orderBy('created_at', 'desc')->limit(6)->get(),
            "product" => $product,
            "productCategory" => Category::where('id', $product->category_id)->first(),
            "categories" => Category::has('products')->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $product = Product::where('slug', $slug)->first();
        return view("product.edit")->with([
            "product" =>$product,
            "categories" => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        //
        $product = Product::where('slug', $slug)->first();
        //validation
        $this->validate($request,[
            "title"=> "required|min:3",
            "description"=> "required|min:5",
            "image"=> "image|mimes:png,jpg,jpe|max:2048",
            "price"=> "required|numeric",
            "category_id"=> "required|numeric",
        ]);
        //update date
        if($request->has("image")){
            $image_path = public_path("storage/images/products/".$product->image);
            if(File::exists($image_path)){
                unlink($image_path);
            }
            $file = $request->image;
            $imageName = time()."_".$file->getClientOriginalName();
            $file->move(public_path("storage/images/products/"),$imageName);
            $product->image = $imageName;
        }
        $title = $request->title;
        $product->update([
            "title" => $title,
            "slug" => Str::slug($title),
            "description" => $request->description,
            "price" => $request->price,
            "old_price" => $request->old_price,
            "inStock" => $request->inStock,
            "category_id" => $request->category_id,
            "image" => $product->image,
        ]);
        return redirect()->route("dashboard")->with("success","Product updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        //
        $product = Product::where('slug', $slug)->first();
        $image_path = public_path("storage\\images\\products\\".$product->image);
        if(File::exists($image_path)){
            unlink($image_path);
        } 
        $product->delete();
        return redirect()->route("dashboard")->with("success", "Product deleted successfully");
    }
}
