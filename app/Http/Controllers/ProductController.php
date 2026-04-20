<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Exception;

class ProductController extends Controller
{
    public function index(Request $request)
{
    $query = Product::with('company');

    // 商品名で部分一致検索
    if ($request->filled('keyword')) {
        $query->where('product_name', 'like', '%' . $request->keyword . '%');
    }

    // メーカーで絞り込み
    if ($request->filled('company_id')) {
        $query->where('company_id', $request->company_id);
    }

    $products = $query->get();

    // メーカー一覧取得
    $companies = Company::all();

    return view('products.index', compact('products', 'companies'));
}

    public function create()
    {
        $companies = Company::all();

        return view('products.create', compact('companies'));
    }

    public function store(StoreProductRequest $request)
    {
        try {
        $product = new Product([
            'product_name' => $request->get('product_name'),
            'company_id'   => $request->get('company_id'),
            'price'        => $request->get('price'),
            'stock'        => $request->get('stock'),
            'comment'      => $request->get('comment'),
        ]);

        if ($request->hasFile('img_path')) {
            $filename = $request->img_path->getClientOriginalName();
            $filePath = $request->img_path->storeAs('products', $filename, 'public');
            $product->img_path = '/storage/' . $filePath;
        }else {
            $product->img_path = null;
            }

        $product->save();

        return redirect('/products')->with('success', '商品を登録しました。');
    } catch (Exception $e) {
        return back()->withInput()->with('error', '商品登録に失敗しました。');
    }
    }

    public function show(Product $product)
    {
        return view('products.show', ['product' => $product]);
    }

    public function edit(Product $product)
    {
        $companies = Company::all();
        return view('products.edit', compact('product', 'companies'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
        $product->product_name = $request->product_name;
        $product->company_id   = $request->company_id;
        $product->price        = $request->price;
        $product->stock        = $request->stock;
        $product->comment      = $request->comment;

        if ($request->hasFile('img_path')) {
            $filename = $request->img_path->getClientOriginalName();
            $filePath = $request->img_path->storeAs('products', $filename, 'public');
            $product->img_path = '/storage/' . $filePath;
        }

        $product->save();

        return redirect()->route('products.show', $product->id)
            ->with('success', '商品を更新しました。');
    } catch (Exception $e) {
        return back()->withInput()->with('error', '商品更新に失敗しました。');
    }
}

   public function destroy(Product $product)
{
    try {
        $product->delete();
        return redirect('/products')->with('success', '商品を削除しました。');
    } catch (Exception $e) {
        return redirect('/products')->with('error', '商品削除に失敗しました。');
    }
}
}

