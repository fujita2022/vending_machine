<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Product;
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

    public function store(Request $request)
    {
        $request->validate(
    [
        'product_name' => 'required|max:255',
        'company_id'   => 'required',
        'price'        => 'required|integer|min:0',
        'stock'        => 'required|integer|min:0',
        'comment'      => 'nullable|max:255',
        'img_path'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ],
    [
        'product_name.required' => '商品名は必須です。',
        'product_name.max' => '商品名は255文字以内で入力してください。',
        'company_id.required' => 'メーカー名は必須です。',
        'price.required' => '価格は必須です。',
        'price.integer' => '価格は半角数字で入力してください。',
        'price.min' => '価格は0以上で入力してください。',
        'stock.required' => '在庫数は必須です。',
        'stock.integer' => '在庫数は半角数字で入力してください。',
        'stock.min' => '在庫数は0以上で入力してください。',
        'comment.max' => 'コメントは255文字以内で入力してください。',
        'img_path.image' => '商品画像は画像ファイルを選択してください。',
        'img_path.mimes' => '商品画像はjpeg,png,jpg,gif形式でアップロードしてください。',
        'img_path.max' => '商品画像は2MB以内にしてください。',
    ]);

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

    public function update(Request $request, Product $product)
    {
        $request->validate(
    [
        'product_name' => 'required|max:255',
        'company_id'   => 'required',
        'price'        => 'required|integer|min:0',
        'stock'        => 'required|integer|min:0',
        'comment'      => 'nullable|max:255',
        'img_path'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ],
    [
        'product_name.required' => '商品名は必須です。',
        'product_name.max' => '商品名は255文字以内で入力してください。',
        'company_id.required' => 'メーカー名は必須です。',
        'price.required' => '価格は必須です。',
        'price.integer' => '価格は半角数字で入力してください。',
        'price.min' => '価格は0以上で入力してください。',
        'stock.required' => '在庫数は必須です。',
        'stock.integer' => '在庫数は半角数字で入力してください。',
        'stock.min' => '在庫数は0以上で入力してください。',
        'comment.max' => 'コメントは255文字以内で入力してください。',
        'img_path.image' => '商品画像は画像ファイルを選択してください。',
        'img_path.mimes' => '商品画像はjpeg,png,jpg,gif形式でアップロードしてください。',
        'img_path.max' => '商品画像は2MB以内にしてください。',
    ]);

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

