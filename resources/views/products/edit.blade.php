@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>商品情報編集</h1>
    <form action="{{ route('products.update', $product->id) }}" method="post">
      @csrf
      @method('PUT')

      <p>
        <label for="product-id">商品情報ID</label>
      </p>

      <p>
        <label for="name">商品名</label>
        <input type="text" name="name" id="name" value="{{ $product->name }}">
      </p>

      <p>
        <label for="maker">メーカー</label>
        <input type="text" name="maker" id="maker" value="{{ $product->company_id }}">
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