<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCataloguesRequest;
use App\Http\Requests\UpdateCataloguesRequest;
use App\Models\Catalogues;
use App\Models\Catelogue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CataloguesController extends Controller
{
    CONST PATH_UPLOAD='catalogues.';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Catalogues::query()->latest('id')->get();
        return view('admin.catalogue.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->except('cover'); // lays tat ca du lieu tru cover
        $data['is_active'] ??=0;

        if($request->hasFile('cover')){
            $data['cover']= Storage::put(self::PATH_UPLOAD, $request->file('cover'));
        }

        Catalogues::query()->create($data);
        return redirect()->route('admin.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Catalogues $catalogues)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Catalogues $catalogues)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCataloguesRequest $request, Catalogues $catalogues)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Catalogues $catalogues)
    {
        //
    }
}
