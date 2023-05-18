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
            <td>{{ $product->company->company_name }}</td>
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