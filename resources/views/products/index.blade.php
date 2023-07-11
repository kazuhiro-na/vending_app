@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="search-form">
      <form id="search-form" action="{{ route('products.index') }}" method="GET">
        <div class="form-group">
          <label for="product_name">商品名</label>
          <input type="text" name="product_name" id="product_name" value="{{ request('product_name') }}">
        </div>
        <div class="form-group">
          <label for="company_name">メーカー名</label>
          <select name="company_name" id="company_name">
            <option value="">--選択してください--</option>
            @foreach($companies as $company)
              <option value="{{ $company->company_name }}"{{ request('company_name') == $company->company_name?'selected':'' }}>{{ $company->company_name }}
              </option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="price_min">価格(下限)</label>
          <input type="number" name="price_min" id="price_min" value="{{ request('price_min') }}" min="0">
        </div>
        <div class="form-group">
          <label for="price_max">価格(上限)</label>
          <input type="number" name="price_max" id="price_max" value="{{ request('price_max') }}" min="0">
        </div>
        <div class="form-group">
          <label for="stock_min">在庫数(下限)</label>
          <input type="number" name="stock_min" id="stock_min" value="{{ request('stock_min') }}" min="0">
        </div>
        <div class="form-group">
          <label for="stock_max">在庫数(上限)</label>
          <input type="number" name="stock_max" id="stock_max" value="{{ request('stock_max') }}" min="0">
        </div>
        <button type="submit">検索</button>
      </form>
    </div>
    <h1>商品一覧画面</h1>
    <div class="products_list">
      <table id="products-table">
        @csrf
        <thead>
          <tr>
            <th>メーカー</th>
            <th>商品画像</th>
            <th>商品名</th>
            <th>値段</th>
            <th>在庫</th>
            <th>コメント</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($products as $product)
          <tr data-id="{{ $product->id }}">
            <td>{{ $product->company->company_name }}</td>
            <td><img src="{{ asset('storage/' . $product->image_path) }}" alt="商品画像" style="max-width: 200px;"></td>
            <td><a href="{{ route('products.show', $product) }}">{{ $product->name }}</a></td>
            <td>{{ $product->price }}円</td>
            <td>{{ $product->stock }}</td>
            <td>{{ $product->comment }}</td>
            <td>
              <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">削除</button>
              </form>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
    <a href="{{ route('products.create') }}">商品を登録する</a>
  </div>
@endsection