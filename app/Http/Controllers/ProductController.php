<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Catalogues;
use GuzzleHttp\Psr7\Request;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $view;
    public function __construct()
    {
        $this->view = [];
    }
    public function index()
    {
        //
        $objPro = new Product();
        $this->view['listPro'] = $objPro->loadDataWithPager();
        $objCate = new Catalogues();
        $listCate = $objCate->loadAllCate();
        $arrayCate = [];
        foreach ($listCate as $value){
            $arrayCate[$value->id] = $value->name;
        }
        $this->view['listCate'] =  $arrayCate;
        return view('admin.product.index', $this->view);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $objCate = new Catalogues();
        $this->view['listCate'] = $objCate->loadAllCate();
        return view('admin.product.create', $this->view);
    }

    /**
     * Store a newly created resource in storage.
     */
    private function uploadFile($file){
        $fileName = time().'_'.$file->getClientOriginalName();
        return $file->storeAs('image_product', $fileName, 'public');
    }
    public function store(StoreProductRequest $request)
    {
        //
        $data = $request->except('image');
        if ($request->hasFile('image') && $request->file('image')->isValid()){
            $data['image'] = $this->uploadFile($request->file('image'));
        }
        $objPro = new Product();
        $res = $objPro->insertDataProduct($data);

        if($res){
            return redirect()->back()->with('success', 'Sản phẩm đã được thêm mới thành công');
        }else{
            return redirect()->back()->with('error', 'Sản phẩm đã được thêm mới không thành công');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
