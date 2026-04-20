<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'product_name' => 'required|max:255',
            'company_id'   => 'required',
            'price'        => 'required|integer|min:0',
            'stock'        => 'required|integer|min:0',
            'comment'      => 'nullable|max:255',
            'img_path'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [
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
        ];
    }
}