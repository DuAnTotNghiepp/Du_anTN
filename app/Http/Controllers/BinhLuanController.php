<?php

namespace App\Http\Controllers;

use App\Models\BinhLuan;
use App\Http\Requests\StoreBinhLuanRequest;
use App\Http\Requests\UpdateBinhLuanRequest;
use App\Models\Product;
use http\Env\Request;
use Illuminate\Support\Facades\Auth;

class BinhLuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(\Illuminate\Http\Request $request, int $int)
    {
        $product = Product::query()->findOrFail($int);
        BinhLuan::create([
            'product_id' => $int,
            'user_id' => Auth::id(),//Auth::id()
            'noidung'=> $request->content,
        ]);

        return back()->with('success', true);

    }

    /**
     * Display the specified resource.
     */
    public function show(BinhLuan $binhLuan)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BinhLuan $binhLuan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBinhLuanRequest $request, BinhLuan $binhLuan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BinhLuan $binhLuan)
    {
        //
    }
}
