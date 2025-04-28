<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>商品詳細</title>
    <link rel="stylesheet" href="{{ asset('css/product.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
</head>
<body>
<header>
    <h1>mogitate</h1>
</header>
<main>
    <div class="search-content">
        <a href="{{ url('/products') }}">商品一覧</a> &gt; {{ $product->name }}
    </div>

    <div class="form">
        <form method="post" action="{{ url('/products/' . $product->id . '/update') }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="form-top">
                <div class="form-left">
                    <img src="{{ asset('storage/images/' . $product->image) }}" alt="">
                    <div class="form-input">
                        <input type="file" name="product_image" accept=".jpeg,.png" class="form-input-img">
                        @foreach ($errors->get('product_image') as $message)
                            <div class="error">{{ $message }}</div>
                        @endforeach
                    </div>
                </div>

                <div class="form-right">
                    <label>商品名</label>
                    <div class="form-input">
                        <input type="text" name="product_name" value="{{ old('product_name', $product->name) }}">
                        @foreach ($errors->get('product_name') as $message)
                            <div class="error">{{ $message }}</div>
                        @endforeach
                    </div>

                    <label>値段</label>
                    <div class="form-input">
                        <input type="text" name="product_price" value="{{ old('product_price', $product->price) }}">
                        @foreach ($errors->get('product_price') as $message)
                            <div class="error">{{ $message }}</div>
                        @endforeach
                    </div>

                    <label>季節</label>
                    <div class="form-row-group">
                        @php
                            $selectedSeasons = old('season', $product->seasons->pluck('id')->toArray());
                            $seasonLabels = ['spring' => '春','summer' => '夏','autumn' => '秋','winter' => '冬'];
                        @endphp
                        @foreach ($seasons as $season)
                            <label>
                                <input type="checkbox" name="season[]" value="{{ $season->id }}"
                                    {{ in_array($season->id, (array) $selectedSeasons) ? 'checked' : '' }}>
                                {{ $seasonLabels[$season->name] ?? $season->name }}
                            </label>
                        @endforeach
                        @foreach ($errors->get('season') as $message)
                            <div class="error">{{ $message }}</div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="form-description">
                <label>商品説明</label>
                <textarea name="product_explain">{{ old('product_explain', $product->description) }}</textarea>
                @foreach ($errors->get('product_explain') as $message)
                    <div class="error">{{ $message }}</div>
                @endforeach
            </div>

        <div class="form-btn-wrapper">
            <form method="POST" action="{{ url('/products/' . $product->id . '/update') }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="form-btn">
                    <button type="button" onClick="history.back()" class="form-btn-rtn">戻る</button>
                    <button type="submit" class="form-btn-update">変更を保存</button>
                </div>
            </form>

            <form method="POST" action="{{ url('/products/' . $product->id . '/delete') }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="form-btn-delete">🗑</button>
            </form>
        </div>
    </div>
</main>
</body>
</html>