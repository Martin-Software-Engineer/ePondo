<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;

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
    public function create($campaign_id)
    {
        
        return view ('jobseeker.products.create',[ 'campaign_id'=> $campaign_id, 'product_categories' => ProductCategory::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($campaign_id, Request $request)
    {
        $data = $request->validate([
            
            'name' => 'required',
            'description' => 'required'
            
        ]);

        $product = new Product();
        $product -> campaign_id = $campaign_id;
        $product -> name = $data['name'];
        $product -> description = $data['description'];
        $product -> save();

        $product->product_categories()->attach($request['product_category']);
        $request ->session()->flash('success','You have created a New Product!');

        // $campaign = Campaign::findOrFail($campaign_id);
        // $products = Product::where('campaign_id',$campaign_id)->paginate(5);

        return redirect(route('jobseeker.campaigns.show',$campaign_id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($campaign_id, Product $product)
    {
        
        $product = Product::where('id',$product->id)->first();
        
        return view('jobseeker.products.show', ['product'=> $product, 'campaign' => $campaign_id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($campaign_id, Product $product)
    {
        return view('jobseeker.products.edit',['product' => $product, 'campaign' => $campaign_id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update($campaign_id, Request $request, Product $product)
    {
        $product->update($request->except(['_token']));

        // $product->product_categories()->sync($request->product_category);

        $request ->session()->flash('success','You have edited the product');

        $product = Product::where('id',$product->id)->first();

        // return view ('productseeker.products.show', ['product'=> $product, 'campaign' => $campaign_id]);
        return redirect(route('jobseeker.campaigns.products.show',[$campaign_id,$product->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
