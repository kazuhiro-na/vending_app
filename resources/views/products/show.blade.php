@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="card">
      <div class="card-header">商品詳細</div>

      <div class="card-body">
        <div class="form-group">
          <label for="product-id">商品情報ID</label>
          <p>{{ $product->id }}</p>
        </div>

        <div class="form-group">
          <label for="name">商品名</label>
          <p>{{ $product->name }}</p>
        </div>

        <div class="form-group">
          <label for="maker">メーカー</label>
          <p>{{ $product->company_id}}</p>
        </div>

        <div class="form-group">
          <label for="price">価格</label>
          <p>{{ $product->price }}</p>
        </div>

        <div class="form-group">
          <label for="stock">在庫数</label>
          <p>{{ $product->stock }}</p>
        </div>

        <div class="comment">
          <label for="comment">コメント</label>
          <p>{{ $product->comment }}</p>
        </div>

        <div class="form-group">
          <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">編集</a>
          <br>
          <a href="{{ route('products.index' }}">戻る</a>
        </div>
        
      </div>
    </div>

  </div>
@endsection