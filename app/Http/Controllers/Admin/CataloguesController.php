<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCataloguesRequest;
use App\Models\Catalogues;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CataloguesController extends Controller
{
    const PATH_UPLOAD = 'catalogues.';

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
    public function store(StoreCataloguesRequest $request)
    {
        $data = $request->except('cover'); // lays tat ca du lieu tru cover
        $data['is_active'] ??= 0;


        Catalogues::query()->create($data);
        return redirect()->route('admin.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Catalogues::findOrFail($id);
        return view('admin.catalogue.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Catalogues::findOrFail($id);
        $data = $request->except('cover');
        $data['is_active'] ??= 0;

        if ($request->hasFile('cover')) {
            $data['cover'] = Storage::put(self::PATH_UPLOAD, $request->file('cover'));
        }
        $currentCover = $item->cover;
        $item->update($data);

        if ($currentCover && Storage::exists($currentCover)) {
            Storage::delete($currentCover);
        }

        return redirect()->route('admin.index')->with('model', $item); // Nếu cần truyền về view khác
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = Catalogues::query()->findOrFail($id);
        $model->delete();
        if ($model->cover && Storage::exists($model->cover)) {
            Storage::delete($model->cover);
        }
        return back();
    }
}
