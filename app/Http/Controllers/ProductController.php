<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProductController extends Controller
{
    // private $product_model;
    
    // public function __construct()
    // {
    //    $this->product_model =  app()->make('App\Product'); //定義
    // }


    //商品全件表示
    public function productView() {            
        // $product = \DB::table('products')->leftjoin('companies','id','=','companies.id')->get();
        $product = \DB::table('products')->select(
            'products.id as products_id',
            'company_id',
            'product_name',
            'price',
            'stock',
            'comment',
            'img_path',
            'company_name'
            )->leftjoin('companies','companies.id','=','products.company_id')->get();
        // dd($product[1]->img_path);
        return view('product',['product' => $product]);
    }

    //商品検索機能
    public function productSearch(Request $req){
        // dd($req->company_select);
        // $users = DB::table('users')->where('name', '=', 'carametal')->get();
        if($req->productName){
            // dd($req->productName);
            $product = \DB::table('products')->select(
            'products.id as products_id',
            'company_id',
            'product_name',
            'price',
            'stock',
            'comment',
            'img_path',
            'company_name'
            )->leftjoin('companies','companies.id','=','products.company_id')->where('product_name',$req->productName)->get();
        }else {
            $product = \DB::table('products')->select(
                'products.id as products_id',
                'company_id',
                'product_name',
                'price',
                'stock',
                'comment',
                'img_path',
                'company_name'
                )->leftjoin('companies','companies.id',
            '=','products.company_id')->where('companies.id',$req->company_select)->get();
        }
        // dd($product->product_name);
        return view('product',['product' => $product]);
    }

    //商品削除機能
    public function productDelete($id){
        $data = \DB::table('products')->where('id',$id)->delete();
        $product = \DB::table('products')->select(
            'products.id as products_id',
            'company_id',
            'product_name',
            'price',
            'stock',
            'comment',
            'img_path',
            'company_name'
            )->leftjoin('companies','companies.id','=','products.company_id')->get();
        // dd($product[1]->img_path);
        return view('product',['product' => $product]);
    }

    //商品詳細表示
    public function productDetialsView($id) {
        // dd($req->productdetail_id);
        $results = \DB::table('products')->where('id',$id)->get();
        // $results = \DB::select('select * from products where id = ?', [1]);
        return view('productdetails',['results'=>$results]);
    }
    
    //商品編集表示
    public function productEditView($id) {
        // $results = \DB::select('select * from products where id = ?', [1]);
        $results = \DB::table('products')->where('id',$id)->get();
        return view('productedit',['results' => $results]);
    }

    //商品編集機能
    public function productEdit(Request $req){
        $data = \DB::table('products')->where('id',$req->id)->update([
            // 'id'=>$req->id,
            'company_id'=>$req->company,
            'product_name'=>$req->productname,
            'price'=>$req->price,
            'stock'=>$req->stock,
            'comment'=>$req->comment,
            'img_path'=>$req->image,
            'updated_at'=>Carbon::now()
        ]);
        $results = \DB::table('products')->where('id',$req->id)->get();
        return view('productedit',['results' => $results]);
    }

    //商品新規登録画面遷移
    public function productNewView() {
       return view('newproduct');
    }

    //商品新規登録
    public function productNewCreate(Request $req) {
        // dd($req->all());;
        // dd(Carbon::now());
        $data = \DB::table('products')->insert([
            // 'company_id'=>$request->input('company'),
            'company_id'=>$req->company,
            'product_name'=>$req->productname,
            'price'=>$req->price,
            'stock'=>$req->stock,
            'comment'=>$req->comment,
            'img_path'=>$req->image,
            'created_at'=>Carbon::now()
        ]);
        return view('newproduct');
    }
}