@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">商品情報詳細</h1>

   <div style="border: 1px solid #000; padding: 40px; max-width: 800px; margin: auto;">
    <div class="row mb-3">
        <div class="col-md-4 fw-bold">ID</div>
        <div class="col-md-8">{{ $product->id }}</div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4 fw-bold">商品画像</div>
        <div class="col-md-8">
            <img src="{{ asset($product->img_path) }}" width="150">
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4 fw-bold">商品名</div>
        <div class="col-md-8">{{ $product->product_name }}</div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4 fw-bold">メーカー</div>
        <div class="col-md-8">{{ $product->company->company_name }}</div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4 fw-bold">価格</div>
        <div class="col-md-8">¥{{ $product->price }}</div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4 fw-bold">在庫数</div>
        <div class="col-md-8">{{ $product->stock }}</div>
    </div>

    <div class="row mb-4">
        <div class="col-md-4 fw-bold">コメント</div>
        <div class="col-md-8">
            <div style="border:1px solid #ccc; padding:10px; width:420px; min-height:110px; background:#fff;">
                {{ $product->comment ?? 'コメントなし' }}
            </div>
        </div>
    </div>

    <div style="margin-top: 20px;">
        <a href="{{ route('products.edit', $product) }}" class="btn btn-warning me-2">編集</a>
        <a href="{{ route('products.index') }}" class="btn btn-info">戻る</a>
    </div>

   </div>
</div>
@endsection