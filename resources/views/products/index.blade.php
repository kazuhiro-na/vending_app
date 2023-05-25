@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="search-form">
      <form action="{{ route('products.index') }}" method="GET">
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
        <button type="submit">検索</button>
      </form>
    </div>
    <h1>商品一覧画面</h1>
    <div class=products_list>
      <table>
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
          <tr>
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