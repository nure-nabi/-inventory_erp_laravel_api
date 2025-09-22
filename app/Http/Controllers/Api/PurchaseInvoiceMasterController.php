<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PurchaseInvoiceMasterModel;
use Illuminate\Http\Request;

class PurchaseInvoiceMasterController extends Controller
{
    //
    public function storePurchaseMaster(Request $request)
    {

           // Generate voucher number manually
           $voucherNo = $this->generateVoucherNumber();
           //   $image = $this->saveImage($request->PSGImg, 'product');
          $purchase =  PurchaseInvoiceMasterModel::create([
            'VoucherNo' =>$request->VoucherNo,
            'VDate' =>$request->VDate,
            'VTime' =>$request->VTime,
            'DueDate' =>$request->DueDate,
            'LedgerId' =>$request->LedgerId,
            'PartyName' => $request->PartyName,
            'CurrencyRate' => $request->CurrencyRate,
            'BasicAmount' => $request->BasicAmount,
            'NetAmount' => $request->NetAmount,
            'PaymentType' => $request->PaymentType,
            'Remarks' => $request->Remarks,
            'EnterBy' => $request->EnterBy,
            'EnterDate' => $request->EnterDate,
            'Gadget' => $request->Gadget,
            'IsBillCancel' => $request->Gadget,
            'PSGImg' => $request->PGImg,
        ]);

        if($purchase){
         return response([
            'message' => 'Purchase successfully.',
            'success' => true,
            'VoucherNo' => $purchase->VoucherNo,
            'Remarks' => $purchase->Remarks,
        ], 200);
        }else{
          return response([
            'message' => 'Something wrong',
            'success' => false,
            'VoucherNo' => "",
        ], 400);
        }

        
    }

    public function getPurchaseInvoiceMasterByVoucherNo($voucherNo)
{
    $vouchersProduct = PurchaseInvoiceMasterModel::
    Where("VoucherNo" ,$voucherNo)    
    ->get();
    
    // Check if products were found
    if ($vouchersProduct->isEmpty()) {
        return response()->json([
            'message' => 'No products found for the given voucher number.',$voucherNo,
            'success' => false,
            'data' => []
        ], 404);
    }
    
    return response()->json([
        'message' => 'Products fetched successfully.',
        'success' => true,
        'data' => $vouchersProduct
    ], 200);
}


     function updatePurchaseMaster(Request $request){
        PurchaseInvoiceMasterModel::where('VoucherNo',$request->VoucherNo)
       ->update([
            'VDate' =>$request->VDate,
            'VTime' =>$request->VTime,
            'DueDate' =>$request->DueDate,
            'LedgerId' =>$request->LedgerId,
            'PartyName' => $request->PartyName,
            'CurrencyRate' => $request->CurrencyRate,
            'BasicAmount' => $request->BasicAmount,
            'NetAmount' => $request->NetAmount,
            'PaymentType' => $request->PaymentType,
            'Remarks' => $request->Remarks,
            'EnterBy' => $request->EnterBy,
            'EnterDate' => $request->EnterDate,
            'Gadget' => $request->Gadget,
            'IsBillCancel' => $request->Gadget,
            'PSGImg' => $request->PGImg,
    ]);
       
       return response([
           'message' => 'Updated Product Price',
           'success' => true,
           'VoucherNo' => $request->VoucherNo
       ]);
   }
   
     public function deletePurchaseInvoiceMaster(Request $request,$voucherNo)
    {
    try {
        if (!$voucherNo) {
            return response([
                'message' => 'VoucherNo is required',
                'success' => false,
            ], 400);
        }
        // Delete the record
        $deletePIM = PurchaseInvoiceMasterModel::where("VoucherNo", $voucherNo)->delete();
        if ($deletePIM) {
            return response([
                'message' => 'Purchase invoice deleted successfully.',
                'success' => true,
                'deleted_count' => $deletePIM
            ], 200);
        } else {
            return response([
                'message' => 'No record found with the specified VoucherNo',
                'success' => false,
            ], 404);
        }
    } catch (\Exception $e) {
        return response([
            'message' => 'Something went wrong: ' . $e->getMessage(),
            'success' => false,
        ], 500);
    }
}
    public function generateVoucherNumber()
{
    $voucherNo = $this->getNextVoucherNumber();
    
    return response()->json([
        'success' => true,
        'VoucherNo' => $voucherNo,
        'message' => 'Voucher number generated successfully'
    ], 200);
}

    private function getNextVoucherNumber()
{
    // Method 1: Get the last voucher and extract number
    $lastVoucher = PurchaseInvoiceMasterModel::where('VoucherNo', 'like', 'PI-%')
        ->orderByRaw('CAST(SUBSTRING(VoucherNo, 4) AS UNSIGNED) DESC')
        ->first();

    $nextNumber = 1;
  
    if ($lastVoucher) {
        // Extract numeric part from voucher number
        $voucherParts = explode('-', $lastVoucher->VoucherNo);
        if (count($voucherParts) === 2 && is_numeric($voucherParts[1])) {
            $nextNumber = (int)$voucherParts[1] + 1;
        }
    }

    return 'PI-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
}
}
