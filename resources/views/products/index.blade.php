@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>商品一覧画面</h1>
    <div class=products_list>
      <table>
        @csrf
        <thead>
          <tr>
            <th>メーカー</th>
            <th>商品名</th>
            <th>値段</th>
            <th>在庫</th>
            <th>コメント</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($products as $product)
          <tr>
            <td>{{ $product->company_id }}</td>
            <td><a href="{{ route('products.show', $product) }}">{{ $product->name }}</a></td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->stock }}</td>
            <td>{{ $product->comment }}</td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
    <a href="{{ route('products.create') }}">商品を登録する</a>
  </div>
@endsection