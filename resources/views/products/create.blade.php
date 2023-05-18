@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="content-header">商品登録</div>

    <div class="content-body">
      <form method="Post" action="{{ route('products.store') }}">
        @csrf

        <div class="form-group row">
          <label for="name">商品名</label>
          <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

          @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div class="form-group row">
          <label for="company_id">メーカー</label>
          <select name="company_id" id="company_id" class="form-control @error('company_id') is-invalid @enderror" name="company_id" value="{{ old('company_id') }}" required autocomplete="company_id" autofocus>
            @foreach($companies as $company)
              <option value="{{ $company->id }}">{{ $company->company_name }}</option>
            @endforeach
          </select>
          @error('company_id')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div class="form-group row">
          <label for="price">価格</label>
          <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price" autofocus>

          @error('price')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div class="form-group row">
          <label for="stock">在庫数</label>
          <input id="stock" type="text" class="form-control @error('stock') is-invalid @enderror" name="stock" value="{{ old('stock') }}" required autocomplete="stock" autofocus>

          @error('stock')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div class="form-group row">
          <label for="comment">コメント</label>
          <textarea name="comment" id="comment"></textarea>
        </div>

        <br>
        <button type="submit" class="btn btn-primary">
          {{__('登録')}}
        </button>
        <a href="{{ route('products.index') }}" class="btn btn-light">戻る</a>
    </div>
  </div>
@endsection