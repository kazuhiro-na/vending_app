@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>商品情報編集</h1>
    <form action="{{ route('products.update', $product->id) }}" method="post">
      @csrf
      @method('PUT')

      <p>
        <label for="product-id">商品情報ID:{{ $product->id }}</label>
      </p>

      <p>
        <label for="name">商品名</label>
        <input type="text" name="name" id="name" value="{{ $product->name }}">
      </p>

      <p>
        <label for="company_id">メーカー</label>
        <select name="company_id" id="company_id" name="company_id" value="{{ $product->company->company_name }}" >
            @foreach($companies as $company)
              <option value="{{ $company->id }}" {{ $product->company_id == $company->id ? 'selected' : '' }}>{{ $company->company_name }}</option>
            @endforeach
        </select>
      </p>

      <p>
        <label for="price">価格</label>
        <input type="text" name="price" id="price" value="{{ $product->price }}">
      </p>

      <p>
        <label for="stock">在庫数</label>
        <input type="text" name="stock" id="stock" value="{{ $product->stock }}">
      </p>

      <p>
        <label for="comment">コメント</label>
        <input type="text" name="comment" id="comment" value="{{ $product->comment }}">
      </p>

      <button type="submit">更新</button>

    </form>
  </div>
@endsection