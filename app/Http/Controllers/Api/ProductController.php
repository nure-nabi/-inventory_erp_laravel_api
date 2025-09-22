<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductModel;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
     public function store(Request $request)
      {
        
          //validate fields
          $attrs = $request->validate([
              'ProductDesc' => 'required|string',
              
          ]);//
        //  $image = $this->saveImage($request->PSGImg, 'product_sub_group');
            $product =  ProductModel::create([
              'ProductDesc' => $attrs['ProductDesc'],
              'ProductShortName' =>$attrs['ProductDesc'],
              'ProductGrpId' => $request->ProductGrpId,
              'ProductSubGrpId' => $request->ProductSubGrpId,
              'BuyRate' => $request->BuyRate,
              'SalesRate' => $request->SalesRate,
              'Status' => $request->Status,
              'EnterBy' => $request->EnterBy,
              'EnterDate' => $request->EnterDate,
              'Gadget' => $request->Gadget,
              'PImage' => "no",
          ]);

         if ($product) {
            return response([
                'message' => 'Product save  successfully',
                'success' => true,
            ]);
        } else {
            return response([
                'message' => 'Not product save ' ,
                'success' => false,
            ], 400);
        }
      }

      function getProduct(Request $request){
       $product = ProductModel::with("category","subCategory")
       ->get();

       if ($product) {
            return response([
                'message' => 'Product fetch  successfully',
                'success' => true,
                'data'=>$product
            ]);
        } else {
            return response([
                'message' => 'Not product ' ,
                'success' => false,
                'data'=> []
            ], 400);
        }
      }
}
