<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\models\Product;
use Illuminate\Database\Eloquent\Model;


class ProductController extends Controller
{   
    public function __construct()
    {
       $product_model =  new Product;
    }


    //商品全件表示
    public function productView() {
        $product_model = new Product;
        $product = $product_model->getAll();
        return view('product',[
            'product' => $product]);
    }

    //商品検索機能
    public function productSearch(Request $req){
        $product_model = new Product;
        $product = $product_model->getSearchQuery($req);
        return view('product',[
            'product' => $product]);
    }

    //商品削除機能
    public function productDelete($id){
        $product_model = new Product;
        $product = $product_model->queryDelete($id);
        return view('product',[
            'product' => $product]);
    }

    //商品詳細表示
    public function productDetialsView($id) {
        $product_model = new Product;
        $results = $product_model->getProductDetail($id);
        return view('productdetails',[
            'results'=>$results]);
    }
    
    //商品編集表示
    public function productEditView($id) {
        $product_model = new Product;
        $results = $product_model->viewEditProduct($id);
        return view('productedit',[
            'results' => $results]);
    }

    //商品編集機能
    public function productEdit(Request $req){
        $product_model = new Product;
        $results = $product_model->editProduct($req);
        return view('productedit',[
            'results' => $results]);
    }

    //商品新規登録画面遷移
    public function productNewView() {
       return view('newproduct');
    }

    //商品新規登録
    public function productNewCreate(Request $req) {
        $product_model = new Product();
        $product_model->insertNewProduct($req);
        return view('newproduct');
    }
}