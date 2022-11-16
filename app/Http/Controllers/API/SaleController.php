<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Sale;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index(Request $req)
    {
        // dd($req->id);
        $saleId = $req->id;
        DB::beginTransaction();
        try {
            $sale = new Sale();
            $sale->decrimentStock($saleId);
            // $result = [
            //     'result' => true,
            //     'id' => $id->id,
            //     'product_id' => $id->product_id
            // ];
            DB::commit();
        }catch(\Exception $e){
            $result = [
                'result' => false,
                'error' => [
                    'messages' => [$e->getMessage()]
                ],
            ];
            return $this->resConversionJson($result, $e->getCode());
        }
        // return $this->resConversionJson($result);
    }

    private function resConversionJson($result,$statusCode=200)
    {
        if(empty($statusCode) || $statusCode < 100 || $statusCode >= 600){
            $statusCode = 500;
        }
        return response()->json($result, $statusCode, ['Content-Type' => 'application/json'], JSON_UNESCAPED_SLASHES);
    }
}
