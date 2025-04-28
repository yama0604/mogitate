<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\Season;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    // 商品一覧ページ表示
    public function index()
    {
        $products = Product::with('seasons')->paginate(6);
        return view('products', compact('products'));
    }

    // 商品検索・並び替え
    public function search()
    {
        $query = Product::query();

        if (request()->filled('product_name')) {
            $query->where('name', 'like', '%' . request('product_name') . '%');
        }

        if (request('tax_sort') === 'tax_sort_high') {
            $query->orderBy('price', 'desc');
        } elseif (request('tax_sort') === 'tax_sort_row') {
            $query->orderBy('price', 'asc');
        }

        $products = $query->with('seasons')->paginate(6)->appends(request()->query());
        return view('products', compact('products'));
    }

    // 商品登録ページ表示
    public function showRegister()
    {
        $seasons = Season::all();
        return view('register', compact('seasons'));
    }

    // 商品登録処理
    public function register(RegisterRequest $request)
    {
        $path = $request->file('product_image')->store('public/images');
        $filename = basename($path);

        $product = Product::create([
            'name'        => $request->input('product_name'),
            'price'       => $request->input('product_price'),
            'image'       => $filename,
            'description' => $request->input('product_explain'),
        ]);

        // 季節の紐づけ（複数選択対応）
        $seasonIds = collect($request->input('season', []))
            ->map(fn($id) => (int) $id)
            ->filter(fn($id) => $id > 0)
            ->values()
            ->all();
        $product->seasons()->attach($seasonIds);

        return redirect('/products')->with('success', '商品を登録しました');
    }

    // 商品詳細ページ表示
    public function product($productId)
    {
        $product = Product::with('seasons')->findOrFail($productId);
        $seasons = Season::all();
        return view('product', compact('product', 'seasons'));
    }

    // 商品更新処理
    public function update(UpdateProductRequest $request, $productId)
    {
        $product = Product::findOrFail($productId);

        if ($request->hasFile('product_image')) {
            $path = $request->file('product_image')->store('public/images');
            $filename = basename($path);
            $product->image = $filename;
        }

        $product->name = $request->input('product_name');
        $product->price = $request->input('product_price');
        $product->description = $request->input('product_explain');
        $product->save();

        // 季節の紐づけ更新
        $seasonIds = collect($request->input('season', []))
            ->map(fn($id) => (int) $id)
            ->filter(fn($id) => $id > 0)
            ->values()
            ->all();
        $product->seasons()->sync($seasonIds);

        return redirect('/products')->with('success', '商品を更新しました');
    }

    // 商品削除処理
    public function delete($productId)
    {
        $product = Product::findOrFail($productId);

        // 紐付けられた季節情報も削除
        $product->seasons()->detach();

        // 商品画像削除
        if ($product->image && Storage::exists('public/images/' . $product->image)) {
            Storage::delete('public/images/' . $product->image);
        }

        $product->delete();
        return redirect('/products')->with('success', '商品を削除しました');
    }
}