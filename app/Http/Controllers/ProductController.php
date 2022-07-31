<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

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
        $product = Product::all();

        $response = [
            'message'=> 'Data Berhasil Terpanggil',
            'data'=> $product
        ];
        return $response;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    $product = Product::create($request->all());


    $response = [
        'message'=>'Mengirimkan Data Product Berhasil',
        'data'=>$product];

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        $product = Product::find($id);

        $response = [
            'message'=>'Menampilkan Detail Data',
            'data'=> 'Detail Data Product',
    ];

    return $response;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $product =Product::findOrFail($id);

        $product->update($request->all());
    
    $response =['message'=> 'Mengupdate Data Product ',
    'data'=> $product
    ];


    return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

    $product =Product::find($id);

    $product->delete();

    $response = ['message'=> 'Menghapus Data Product',
    'data'=>$product
    ];

    return $response;
    }
}
