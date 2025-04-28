<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品一覧</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/products.css') }}">
</head>
<body>
<header>
    <h1>mogitate</h1>
</header>

<main>
    <div class="title">
        <div class="title-left">商品一覧</div>
        <div class="title-right">
            <a href="/products/register" class="title-right-link">＋商品を追加</a>
        </div>
    </div>

    <div class="container">
        <div class="left">
            <form action="{{ url('/products/search') }}" method="get">
                <div class="left-input">
                    <input type="text" name="product_name" value="{{ request('product_name') }}" placeholder="商品名で検索">
                </div>
                <div class="left-btn">
                    <button type="submit">検索</button>
                </div>
                <div class="left-label">価格順で表示</div>
                <div class="left-select-group">
                    <select name="tax_sort" onchange="this.form.submit()">
                        <option value="">価格で並び替え</option>
                        <option value="tax_sort_high" {{ request('tax_sort') == 'tax_sort_high' ? 'selected' : '' }}>高い順に表示</option>
                        <option value="tax_sort_row" {{ request('tax_sort') == 'tax_sort_row' ? 'selected' : '' }}>低い順に表示</option>
                    </select>
                </div>
                {{-- 並び替えタグ表示 --}}
                @if (request('tax_sort'))
                    <div class="left-tag">
                        {{ request('tax_sort') === 'tax_sort_high' ? '高い順に表示' : '低い順に表示' }}
                        <a class="left-tag-close" href="{{ url('/products/search') }}?product_name={{ request('product_name') }}">×</a>
                    </div>
                @endif
            </form>
        </div>

        <div class="right">
            @foreach ($products as $product)
                <div class="right-product">
                    <a href="/products/{{ $product->id }}">
                        <img src="{{ asset('storage/images/' . $product->image) }}" alt="{{ $product->name }}">
                        <div class="product-info">
                            <p class="product-name">{{ $product->name }}</p>
                            <p class="product-price">¥{{ number_format($product->price) }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <div class="pagination-wrap">
        {{ $products->appends(request()->query())->links() }}
    </div>
</main>
</body>
</html>
