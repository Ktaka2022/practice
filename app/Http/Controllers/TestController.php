<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
 
class TestController extends Controller
{
    public function func() {
        return view('test');
    }

    public function ajaxMessage(Request $request){
      $data = $request->all();
      $message = $data['text'];
      return $message;
    }
}