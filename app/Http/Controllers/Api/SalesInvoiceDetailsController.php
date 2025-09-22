<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SalesInvoiceDetailsModel;
use Illuminate\Http\Request;

class SalesInvoiceDetailsController extends Controller
{
    public function storeSalesInvoiceDetails(Request $request, $voucherNo)
{
    try {
         $items = $request->input('products');
        // Validate the request
        // $request->validate([
        //     '*.BasicAmount' => 'required'
        // ]);
        $i = 0;
        $total = count($items);
        $savedItems = [];

        foreach ($items as $item) {
            $i++;

            $data = [
                'VoucherNo' =>  $voucherNo,
                'ProductId' => $item['ProductId'],
                'ProductGrpId' => $item['ProductGrpId'],
                'ProductSubGrpId' => $item['ProductSubGrpId'],
                'SalesmanId' => $item['SalesmanId'],
                'LedgerId' => $item['LedgerId'],
                'Godown' => $item['Godown'],
                'Unit' => $item['Unit'],
                'Qty' => $item['Qty'],
                'SalesRate' => $item['PurchaseRate'],
                'BasicAmount' => $item['BasicAmount'],
                'NetAmount' => $item['NetAmount'],
                'PaymentType' => $item['PaymentType'],
                'EnterBy' => $item['EnterBy'],
                'EnterDate' => $item['EnterDate'],
                'Gadget' => $item['Gadget'],
            ];
            // ✅ Add Remarks only for the last item
            if ($i === $total) {
                $data['Remarks'] = $item['Remarks'];
            }
            $salesDetail = SalesInvoiceDetailsModel::create($data);
            $savedItems[] = $salesDetail;
        }

        return response()->json([
            'message' => 'Your data has been successfully saved',
            'voucherNo' => $voucherNo,
            'success' => true,
            'data' => $savedItems
        ], 200);

    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Error saving sales details: ' . $e->getMessage(),
            'VoucherNo'=>$voucherNo,
            'success' => false,
            'data' =>$items
        ], 500);
    }
}
 public function deleteSalesInvoiceDetails(Request $request)
    {
    try {
        if (!$request->VoucherNo) {
            return response([
                'message' => 'VoucherNo is required',
                'success' => false,
            ], 400);
        }
        // Delete the record
        $deleteSIM = SalesInvoiceDetailsModel::where("VoucherNo", $request->VoucherNo)->delete();
        if ($deleteSIM) {
            return response([
                'message' => 'Sales invoice details deleted successfully.',
                'success' => true,
               // 'deleted_count' => $deleteSIM
            ], 200);
        } else {
            return response([
                'message' => 'No record found with the specified VoucherNo',
                'success' => false,
               // 'voucherNo'=>$deleteSIM
            ], 404);
        }
    } catch (\Exception $e) {
        return response([
            'message' => 'Something went wrong: ' . $e->getMessage(),
            'success' => false,
        ], 500);
    }
}

public function getSalesInvoiceVoucher(Request $request)
{
    $vouchers = SalesInvoiceDetailsModel::select('VoucherNo')
        ->distinct()
        ->get();
    
    return response()->json([
        'message' => 'Distinct vouchers fetched successfully.',
        'success' => true,
        'data' => $vouchers
    ], 200);
}
 function updateSalesInvoiceDetails(Request $request){
       $items = $request->input('products');
       $savedItems = [];
      foreach ($items as $item) {
      $salesDetail =  SalesInvoiceDetailsModel::where('VoucherNo',$request->VoucherNo)
       ->update([
        'ProductId' => $item['ProductId'],
                'ProductGrpId' => $item['ProductGrpId'],
                'ProductSubGrpId' => $item['ProductSubGrpId'],
                'SalesmanId' => $item['SalesmanId'],
                'LedgerId' => $item['LedgerId'],
                'Godown' => $item['Godown'],
                'Unit' => $item['Unit'],
                'Qty' => $item['Qty'],
                'SalesRate' => $item['SalesRate'],
                'BasicAmount' => $item['BasicAmount'],
                'NetAmount' => $item['NetAmount'],
                'PaymentType' => $item['PaymentType'],
                'Remarks' => $item['Remarks'],
                'EnterBy' => $item['EnterBy'],
                'EnterDate' => $item['EnterDate'],
                'Gadget' => $item['Gadget'],
        ]);
        $savedItems[] = $salesDetail;
      }
      if($savedItems){
       return response([
           'message' => 'Updated sales invoice',
           'success' => true,
       ]);
      }else{
        return response([
           'message' => 'No updated sales invoice',
           'success' => false,
       ]);
      }
       
   }
   public function getProductSalesInvoiceByVoucherNo($voucherNo)
{
    $vouchersProduct = SalesInvoiceDetailsModel::with("product","category","subCategory","ledger")
    ->Where("VoucherNo" ,$voucherNo)
        
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
}
