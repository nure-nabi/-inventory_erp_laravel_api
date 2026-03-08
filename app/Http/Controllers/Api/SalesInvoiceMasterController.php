<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SalesInvoiceMasterModel;
use Illuminate\Http\Request;

class SalesInvoiceMasterController extends Controller
{
    //
     public function storeSalesInvoiceMaster(Request $request)
    {
           //   $image = $this->saveImage($request->PSGImg, 'product');
          $purchase =  SalesInvoiceMasterModel::create([
            'VoucherNo' =>$request->VoucherNo,
            'VDate' =>$request->VDate,
            'VTime' =>$request->VTime,
            'DueDate' =>$request->DueDate,
            'LedgerId' =>$request->LedgerId,
            'SalesmanId' =>$request->SalesmanId,
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
    public function getSalesInvoiceMasterByVoucherNo($voucherNo)
{
    $vouchersProduct = SalesInvoiceMasterModel::
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
function updateSalesInvoiceMaster(Request $request){
        SalesInvoiceMasterModel::where('VoucherNo',$request->VoucherNo)
       ->update([
            'VDate' =>$request->VDate,
            'VTime' =>$request->VTime,
            'DueDate' =>$request->DueDate,
            'LedgerId' =>$request->LedgerId,
            'SalesmanId' =>$request->SalesmanId,
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
    public function deleteSalesInvoiceMaster(Request $request)
    {
    try {
        if (!$request->VoucherNo) {
            return response([
                'message' => 'VoucherNo is required',
                'success' => false,
            ], 400);
        }
        // Delete the record
        $deletePIM = SalesInvoiceMasterModel::where("VoucherNo", $request->VoucherNo)->delete();
        if ($deletePIM) {
            return response([
                'message' => 'Sales invoice deleted successfully.',
                'success' => true,
                //'deleted_count' => $deletePIM
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

 public function getSalesInvoiceMasterLimit10()
{
    $vouchersProduct = SalesInvoiceMasterModel::
    limit(10)    
    ->get();
    
    // Check if products were found
    if ($vouchersProduct->isEmpty()) {
        return response()->json([
            'message' => 'No products found for the given voucher number.',
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



     public function generateSalesInvoiceVoucherNumber()
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
    $lastVoucher = SalesInvoiceMasterModel::where('VoucherNo', 'like', 'SI-%')
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

    return 'SI-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
}
}
