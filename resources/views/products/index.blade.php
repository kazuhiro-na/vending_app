<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>自動販売機管理システム</title>
  </head>
  <body>
    <h1>商品一覧画面</h1>
    <div class=products_list>
      <table>
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
            <td>{{ $product->name }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->stock }}</td>
            <td>{{ $product->comment }}</td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </body>
</html>