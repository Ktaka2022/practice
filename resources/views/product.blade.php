@extends('layouts.app')

@section('content')
        <div>商品一覧です。</div>
        <form action="{{ route('productsearch') }}" method="POST">
        {{ csrf_field() }}
        <div><input type="text" name="productName">商品名</div>
            <select name="company_select">
                <option value="1">キットカット</option>
                <option value="2">てすた！</option>
                <option value="3">サンプル3</option>
            </select>
            <input type="submit" value="検索">
        </form>

        <a href="{{ route('newproduct') }}"><input type="button" id="create_button" value="新規登録"></a>
        <table id="product">
            <tr>
                <th>id</th>
                <th>商品画像</th>
                <th>商品名</th>
                <th>価格</th>
                <th>在庫数</th>
                <th>メーカー名</th>
            </tr>
            @foreach($product as $product)
            <tr>
                    <td>{{$product->products_id}}</td>
                    <td><img src="{{asset('image/'.$product->img_path)}}" height="300" width="300"></td>
                    <td>{{$product->product_name}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->stock}}</td>
                    <td>{{$product->company_name}}</td>
                    <td><a href="{{ route('productdetails',$product->products_id) }}"><input type="button" value="詳細表示" name=""></a><td>
                    <td><a href="{{ route('productdelete',$product->products_id) }}"><input type="button" value="削除"></a></td> 
            </tr>
            @endforeach
        </table>
@endsection