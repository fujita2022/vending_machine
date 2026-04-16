@extends('layouts.app')

@section('content')
<div class="container">
    <h1 style="margin-bottom: 40px;">商品新規登録画面</h1>

    <div style="border: 1px solid #999; padding: 50px 60px; width: 900px; background-color: #fff;">
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if ($errors->any())
    <div style="color: red; margin-bottom: 20px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

            <div style="display: flex; align-items: center; margin-bottom: 35px;">
                <label for="product_name" style="width: 250px; font-size: 28px; font-weight: bold;">
                    商品名<span style="color: red;">*</span>
                </label>
                <input type="text" name="product_name" id="product_name" value="{{ old('product_name') }}"
                    style="width: 420px; height: 45px;">
            </div>

            <div style="display: flex; align-items: center; margin-bottom: 35px;">
                <label for="company_id" style="width: 250px; font-size: 28px; font-weight: bold;">
                    メーカー名<span style="color: red;">*</span>
                </label>
                <select name="company_id" id="company_id" style="width: 420px; height: 45px;">
                    <option value=""></option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                            {{ $company->company_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="display: flex; align-items: center; margin-bottom: 35px;">
                <label for="price" style="width: 250px; font-size: 28px; font-weight: bold;">
                    価格<span style="color: red;">*</span>
                </label>
                <input type="text" name="price" id="price" value="{{ old('price') }}"
                    style="width: 420px; height: 45px;">
            </div>

            <div style="display: flex; align-items: center; margin-bottom: 35px;">
                <label for="stock" style="width: 250px; font-size: 28px; font-weight: bold;">
                    在庫数<span style="color: red;">*</span>
                </label>
                <input type="text" name="stock" id="stock" value="{{ old('stock') }}"
                    style="width: 420px; height: 45px;">
            </div>

            <div style="display: flex; align-items: flex-start; margin-bottom: 35px;">
                <label for="comment" style="width: 250px; font-size: 28px; font-weight: bold; margin-top: 10px;">
                    コメント
                </label>
                <textarea name="comment" id="comment" style="width: 420px; height: 110px;">{{ old('comment') }}</textarea>
            </div>

            <div style="display: flex; align-items: center; margin-bottom: 120px;">
                <label for="img_path" style="width: 250px; font-size: 28px; font-weight: bold;">
                    商品画像
                </label>
                <input type="file" name="img_path" id="img_path">
            </div>

            <div style="display: flex; gap: 80px;">
                <button type="submit" class="btn btn-warning">新規登録</button>
                <a href="{{ route('products.index') }}" class="btn btn-info">戻る</a>
            </div>
        </form>
    </div>
</div>
@endsection