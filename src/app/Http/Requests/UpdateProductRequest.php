<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    private const MAX_PRICE = 10000;
    private const MAX_EXPLAIN_LENGTH = 120;
    private const ALLOWED_IMAGE_EXTENSIONS = ['jpeg', 'jpg', 'png'];

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_name' => 'required|string|max:255',
            'season'       => 'required|array|min:1',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // 値段チェック
            $price = $this->input('product_price');
            if ($price === null || $price === '') {
                $validator->errors()->add('product_price', '値段を入力してください');
                $validator->errors()->add('product_price', '数値で入力してください');
                $validator->errors()->add('product_price', '0〜' . self::MAX_PRICE . '円以内で入力してください');
            } else {
                if (!is_numeric($price)) {
                    $validator->errors()->add('product_price', '数値で入力してください');
                } elseif ($price < 0 || $price > self::MAX_PRICE) {
                    $validator->errors()->add('product_price', '0〜' . self::MAX_PRICE . '円以内で入力してください');
                }
            }

            // 商品画像（任意でアップロードされた場合のみ拡張子をチェック）
            if ($this->hasFile('product_image')) {
                $file = $this->file('product_image');
                if (!in_array($file->extension(), self::ALLOWED_IMAGE_EXTENSIONS)) {
                    $validator->errors()->add('product_image', '「.png」または「.jpeg」形式でアップロードしてください');
                }
            }

            // 商品説明チェック
            $explain = $this->input('product_explain');
            if ($explain === null || $explain === '') {
                $validator->errors()->add('product_explain', '商品説明を入力してください');
                $validator->errors()->add('product_explain', self::MAX_EXPLAIN_LENGTH . '文字以内で入力してください');
            } elseif (mb_strlen($explain) > self::MAX_EXPLAIN_LENGTH) {
                $validator->errors()->add('product_explain', self::MAX_EXPLAIN_LENGTH . '文字以内で入力してください');
            }
        });
    }

    public function messages(): array
    {
        return [
            'product_name.required' => '商品名を入力してください',
            'season.required'       => '季節を選択してください',
        ];
    }
}
