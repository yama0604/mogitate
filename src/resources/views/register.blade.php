<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品登録</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
</head>
<body>
<header>
    <h1>mogitate</h1>
</header>
<main>
    <h2>商品登録</h2>
    <div class="form">
        <form method="POST" action="/products/register" enctype="multipart/form-data">
            @csrf

            <div class="form-label">
                <label>商品名 <span class="required">必須</span></label>
            </div>
            <div class="form-input">
                <input type="text" name="product_name" placeholder="商品名を入力" class="form-input-text" value="{{ old('product_name') }}">
                @foreach ($errors->get('product_name') as $message)
                    <div class="error">{{ $message }}</div>
                @endforeach
            </div>

            <div class="form-label">
                <label>値段 <span class="required">必須</span></label>
            </div>
            <div class="form-input">
                <input type="text" name="product_price" placeholder="値段を入力" class="form-input-text" value="{{ old('product_price') }}">
                @foreach ($errors->get('product_price') as $message)
                    <div class="error">{{ $message }}</div>
                @endforeach
            </div>

            <div class="form-label">
                <label>商品画像 <span class="required">必須</span></label>
            </div>
            <div class="form-input">
                <input type="file" name="product_image" accept=".jpeg, .png" class="form-input-img">
                @foreach ($errors->get('product_image') as $message)
                    <div class="error">{{ $message }}</div>
                @endforeach
            </div>

            <div class="form-row">
                <label>季節 <span class="required">必須</span> <span class="required-2">複数選択可</span></label>
                <div class="form-row-group">
                    <div class="form-radio-group">
                        @php
                            $oldSeasons = old('season', []);
                            $seasonLabels = ['spring' => '春','summer' => '夏','autumn' => '秋','winter' => '冬'];
                        @endphp
                        @foreach ($seasons as $season)
                            <label class="season-option">
                                <input type="checkbox" name="season[]" value="{{ $season->id }}" class="form-row-radio"
                                    {{ in_array($season->id, (array) old('season', [])) ? 'checked' : '' }}>
                                {{ $seasonLabels[$season->name] ?? $season->name }}
                            </label>
                        @endforeach
                    </div>
                    <div class="error-wrap">
                        @foreach ($errors->get('season') as $message)
                            <div class="error">{{ $message }}</div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="form-label">
                <label>商品説明 <span class="required">必須</span></label>
            </div>
            <div class="form-input">
                <textarea name="product_explain" placeholder="商品の説明を入力" class="form-row-input1">{{ old('product_explain') }}</textarea>
                @foreach ($errors->get('product_explain') as $message)
                    <div class="error">{{ $message }}</div>
                @endforeach
            </div>

            <div class="form-btn">
                <button type="button" onClick="history.back()" class="form-btn-rtn">戻る</button>
                <button type="submit">登録</button>
            </div>
        </form>
    </div>
</main>
</body>
</html>
