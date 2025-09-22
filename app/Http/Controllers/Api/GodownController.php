<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GodownModel;
use Illuminate\Http\Request;

class GodownController extends Controller
{
    //

     function saveGodown(Request $request){
          $attrs = $request->validate([
            'GodownDesc' => 'required|string'
        ]); 
       $godown =  GodownModel::create([
       'GodownDesc' => $attrs['GodownDesc'],
       'Status' =>$request->Status,
       'EnterBy' =>$request->EnterBy,
       'EnterDate' =>$request->EnterDate,
      ]);

      if($godown){
        return response([
            'message' => 'Unit save successfully.',
            'success' => true,
            'data' => $godown
        ],200);
      }else{
      return response([
            'message' => 'Unit not save.',
            'success' => false,
            'data' => []
        ],200);
      }
    }

    function getGodown(){
      $allGodown =  GodownModel::all();

      if($allGodown){
       return response([
            'message' => 'Godown fetch successfully.',
            'success' => true,
            'data' => $allGodown
        ],200);
      }else{
return response([
            'message' => 'Record no found.',
            'success' => false,
            'data' => []
        ],200);
      }
    }
     function deleteGodownById(Request $request){
        $delete = GodownModel::where('GodownId',$request->GodownId)
        ->delete();

        if($delete){
         return response([
            'message' => "Godown delete successfully",
            'statusCode' => 200,
            'success' => true,
            
        ],200);
        }else{
        return response([
            'statusCode' => 401,
            'success' => false,
            
        ],200);
        }
    }
     function updateGodown(Request $request){
        
       $updated = GodownModel::where('GodownId', operator: $request->GodownId)
    ->update([
        'GodownDesc' => $request->GodownDesc,
    ]);

        if ($updated) {
            return response([
                'message' => 'Godown updated successfully',
                'success' => true,
            ]);
        } else {
            return response([
                'message' => 'No changes made or GodownDesc not ',
                'success' => false,
            ], 400);
        }
            }
     function updateStatusGodown(Request $request){
        // Update the rating using update() method
       $updated = GodownModel::where('GodownId', operator: $request->GodownId)
       ->update(['Status' => $request->Status]);
        if ($updated) {
            return response([
                'message' => 'Godown status updated successfully',
                'success' => true,
            ]);
        } else {
            return response([
                'message' => 'No changes made or godown not ' ,
                'success' => false,
            ], 400);
        }
            }
}
