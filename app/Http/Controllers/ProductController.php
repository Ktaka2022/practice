<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\models\Product;
use Illuminate\Database\Eloquent\Model;

class ProductController extends Controller
{   
    public $product_model;

    public function __construct()
    {
        $this->product_model = new Product();
    }


    //商品全件表示
    public function productView() {
        $product = $this->product_model->getAll();
        return view('product',[
            'product' => $product]);
    }

    //商品検索機能
    public function productSearch(Request $req){
        // dd($req->all());
        $product = $this->product_model->getSearchQuery($req);
        // dd($product);
        return response()->json($product);
    }

    //商品削除機能
    public function productDelete(Request $req){
        // dd($req->delid);
        $product = $this->product_model->queryDelete($req);
        // dd($product->all());
        return response()->json($product);
    }

    //商品詳細表示
    public function productDetialsView($id) {
        $results = $this->product_model->getProductDetail($id);
        return view('productdetails',[
            'results'=>$results]);
    }
    
    //商品編集表示
    public function productEditView($id) {
        $product = $this->product_model->viewEditProduct($id);
        return view('productedit',[
            'product' => $product]);
    }

    //商品編集機能
    public function productEdit(Request $req){
        $product = $this->product_model->editProduct($req);
        return view('productedit',[
            'product' => $product]);
    }

    //商品新規登録画面遷移
    public function productNewView() {
       return view('newproduct');
    }

    //商品新規登録
    public function productNewCreate(Request $req) {
        $this->product_model->insertNewProduct($req);
        return view('newproduct');
    }

    //商品ソート機能
    public function productSort(Request $req){
        // dd($req->all());
        if(substr($req->sort,-3) === 'Asc'){
            $sorttype = substr($req->sort,-3);
            $sortname = substr($req->sort,0,-3);
        }else if(substr($req->sort,-4) === 'Desc'){
            $sorttype = substr($req->sort,-4);
            $sortname = substr($req->sort,0,-4);
        }else {
            $sorttype = null;
            $sortname = null;
        }
        $product = $this->product_model->sortProduct($req,$sorttype,$sortname);
        // dd($product);
        return response()->json($product);

    }
}