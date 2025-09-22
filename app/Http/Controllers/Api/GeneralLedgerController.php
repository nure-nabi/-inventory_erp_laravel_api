<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GeneralLedgerModel;
use Illuminate\Http\Request;

class GeneralLedgerController extends Controller
{
    public function saveGeneralLedger(Request $request)
    {
        //validate fields
        $attrs = $request->validate([
            'GlDesc' => 'required|string',
            'GlCategory' => 'required|string',
            'MobileNo' => 'required|string',
            'Address' => 'required|string'

        ]); 

        $ledger =  GeneralLedgerModel::create([
            
            'GlDesc' => $attrs['GlDesc'],
            'GlCategory' => $attrs['GlCategory'],
            'MobileNo' => $attrs['MobileNo'],
            'Address' => $attrs['Address'],
            'SalesmanId' => $request->SalesmanId,
            'CreditLimit' => $request->CreditLimit,
            'Email' => $request->Email,
            'DOB' => $request->DOB,
            'Gender' => $request->Gender,
            'Status' =>$request->Status,
            'EnterBy' => $request->EnterBy,
            'EnterDate' => $request->EnterDate,
            'Gadget' => $request->Gadget,
            'GLImage' => $request->GLImage,
        ]);

        if($ledger){
return response([
            'message' => 'Ledger save successfully.',
            'statusCode' => 200,
            'success' => true,
            'data' => $ledger
        ],200);
        }else{
return response([
            'message' => 'Ledger save successfully.',
            'statusCode' => 200,
            'success' => true,
            'data' => []
        ],200);
        }
    }
    

    function getLedger(){
         $allLedger = GeneralLedgerModel::select("LedgerId","GlDesc","GlCategory","Gender","MobileNo","Status","EnterDate")
         ->get();

         return response([
            'statusCode' => 200,
            'success' => true,
            'data' => $allLedger
        ],200);
    }
    function getLedgerVendor(){
         $allLedger = GeneralLedgerModel::select("LedgerId","GlDesc","GlCategory","Gender","MobileNo","Status","EnterDate")
         ->where("GlCategory","Vendor")
         ->get();

         return response([
            'statusCode' => 200,
            'success' => true,
            'data' => $allLedger
        ],200);
    }
    function getLedgerCustomer(){
         $allLedger = GeneralLedgerModel::select("LedgerId","GlDesc","GlCategory","Gender","MobileNo","Status","EnterDate")
         ->where("GlCategory","Customer")
         ->get();

         return response([
            'statusCode' => 200,
            'success' => true,
            'data' => $allLedger
        ],200);
    }

    function deleteLedgerById(Request $request){
        $delete = GeneralLedgerModel::where('LedgerId',$request->LedgerId)
        ->delete();

        if($delete){
         return response([
            'message' => "Ledger delete successfully",
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


    function updateLedger(Request $request){
        
       $updated = GeneralLedgerModel::where('LedgerId', operator: $request->LedgerId)
    ->update([
        'GlDesc' => $request->GlDesc,
        'GlCategory' => $request->GlCategory,
        'MobileNo' => $request->MobileNo,
        'Address' => $request->Address,
        'Email' => $request->Email,
        'DOB' => $request->DOB,
        'Gender' => $request->Gender,
    ]);

        if ($updated) {
            return response([
                'message' => 'Ledger updated successfully',
                'success' => true,
            ]);
        } else {
            return response([
                'message' => 'No changes made or ledger not ',$request->CategoryId ,
                'success' => false,
            ], 400);
        }
            }

        function updateStatusLedger(Request $request){
        // Update the rating using update() method
       $updated = GeneralLedgerModel::where('LedgerId', operator: $request->LedgerId)
       ->update(['Status' => $request->Status]);
        if ($updated) {
            return response([
                'message' => 'Ledger status updated successfully',
                'success' => true,
            ]);
        } else {
            return response([
                'message' => 'No changes made or ledger not ' ,
                'success' => false,
            ], 400);
        }
            }
}
