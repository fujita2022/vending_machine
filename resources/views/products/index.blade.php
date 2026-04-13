@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">商品一覧</h1>

<form action="{{ route('products.index') }}" method="GET" style="margin-bottom: 30px;">
    <div style="display: flex; align-items: end; gap: 20px;">
        <div>
            <label for="keyword">商品名</label><br>
            <input
                type="text"
                name="keyword"
                id="keyword"
                value="{{ request('keyword') }}"
                placeholder="商品名を入力"
                style="width: 300px; height: 38px;"
            >
        </div>

        <div>
            <label for="company_id">メーカー名</label><br>
            <select
                name="company_id"
                id="company_id"
                style="width: 200px; height: 38px;"
            >
                <option value="">全て</option>
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}" {{ request('company_id') == $company->id ? 'selected' : '' }}>
                        {{ $company->company_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <button type="submit" class="btn btn-primary">検索</button>
        </div>
    </div>
</form>

<div style="border: 1px solid #ccc; padding: 20px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
    <h2 style="margin: 0;">商品情報</h2>
    <a href="{{ route('products.create') }}" class="btn btn-primary">商品新規登録</a>
</div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>商品名</th>
                <th>メーカー</th>
                <th>価格</th>
                <th>在庫</th>
                <th>コメント</th>
                <th>商品画像</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->company->company_name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->comment }}</td>
                    <td><img src="{{ asset($product->img_path) }}" alt="商品画像" width="100"></td>
                    <td>
                       <a href="{{ route('products.show', $product) }}" class="btn btn-info btn-sm mx-1">詳細</a>
                        <form method="POST" action="{{ route('products.destroy', $product) }}" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm mx-1">削除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </div>
</div>
@endsection
