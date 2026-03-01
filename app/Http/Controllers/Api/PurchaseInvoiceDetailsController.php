<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PurchaseInvoiceDetailsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseInvoiceDetailsController extends Controller
{
    //

    public function storePurchasedetails(Request $request)
    {
     //   $image = $this->saveImage($request->PSGImg, 'product');
     $items = $request->input('products');
      foreach ($items as $item) {

      }
      return response([
            'message' => 'Purchase successfully.', $request->VoucherNo,
            'success' => true,
            'data' => $items
        ], 200);
        //   $purchase =  PurchaseInvoiceDetailsModel::create([
        //     'VoucherNo' =>$request->VoucherNo,
        //     'ProductId' =>$request->ProductId,
        //     'ProductGrpId' =>$request->ProductGrpId,
        //     'ProductSubGrpId' =>$request->ProductSubGrpId,
        //     'SalesmanId' =>$request->SalesmanId,
        //     'LedgerId' =>$request->LedgerId,
        //     'Godown' => $request->Godown,
        //     'Unit' => $request->Unit,
        //     'Qty' => $request->Qty,
        //     'PurchaseRate' => $request->PurchaseRate,
        //     'BasicAmount' => $request->BasicAmount,
        //     'NetAmount' => $request->NetAmount,
        //     'PaymentType' => $request->PaymentType,
        //     'Remarks' => $request->Remarks,
        //     'EnterBy' => $request->EnterBy,
        //     'EnterDate' => $request->EnterDate,
        //     'Gadget' => $request->Gadget,
        //     'PSGImg' => $request->PGImg
      
        // ]);

        // if($purchase){
        //  return response([
        //     'message' => 'Purchase successfully.',
        //     'success' => true,
        //     'VoucherNo' => $purchase->VoucherNo,
        // ], 200);
        // }else{
        //   return response([
        //     'message' => 'Something wrong',
        //     'success' => false,
        //     'VoucherNo' => "",
        // ], 400);
        // }

        
    }

    // public function addSizeColorsDetails(Request $request)
    // {
       
    //     $items = $request->input('SizeColorsDetails');
    
    //     foreach ($items as $item) {
            
    //       //  $image = $this->saveImage($item['ProductImage'], 'product');
           
    //         PurchaseInvoiceDetailsModel::create([
    //             'ProductId' => $lastProductId, 
    //             'SizeName' => $item['SizeName'],
    //             'SellerId' => $item['SellerId'],
    //            'ColorName' => $item['ColorName'],
    //            'ProductImage' =>$image,
    //            'Price' => $item['Price'],
    //            'Stock' => $item['Stock'],
    //            'SpecialPrice' => $item['SpecialPrice'],
    //            'StartDate' => $item['StartDate'],
    //            'EndDate' => $item['EndDate'],
    //            'EntryDate' => $item['EntryDate'],
    //            'Status' => $item['Status'] ,
    //            'created_at' => now(),
    //            'updated_at' => now(),
    //         ]);
    
    //     }
    
    //     return response([
    //         'message' => 'Images uploaded successfully.',
    //         'status' => 'success',
    //     ]);
    // }

   

public function storePurchaseDetails2(Request $request, $voucherNo)
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
                'PurchaseRate' => $item['PurchaseRate'],
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

            $purchaseDetail = PurchaseInvoiceDetailsModel::create($data);

            $savedItems[] = $purchaseDetail;
        }

        return response()->json([
            'message' => 'Purchase successfully saved.',
            'voucherNo' => $voucherNo,
            'success' => true,
            'data' => $savedItems
        ], 200);

    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Error saving purchase details: ' . $e->getMessage(),
            'jj'=>"voucherNo",
            'success' => false,
            'data' =>$items
        ], 500);
    }
}


    function updatePurchaseInvoiceDetails(Request $request){
       $items = $request->input('products');
       $savedItems = [];
      foreach ($items as $item) {
      $purchaseDetail =  PurchaseInvoiceDetailsModel::where('VoucherNo',$request->VoucherNo)
       ->update([
        'ProductId' => $item['ProductId'],
        'ProductGrpId' => $item['ProductGrpId'],
        'ProductSubGrpId' => $item['ProductSubGrpId'],
        'SalesmanId' => $item['SalesmanId'],
        'LedgerId' => $item['LedgerId'],
        'Godown' => $item['Godown'],
        'Unit' => $item['Unit'],
        'Qty' => $item['Qty'],
        'PurchaseRate' => $item['PurchaseRate'],
        'BasicAmount' => $item['BasicAmount'],
        'NetAmount' => $item['NetAmount'],
        'PaymentType' => $item['PaymentType'],
        'Remarks' => $item['Remarks'],
        'EnterBy' => $item['EnterBy'],
        //'EnterDate' => $item['EnterDate'],
        'Gadget' => $item['Gadget'],
        ]);
        $savedItems[] = $purchaseDetail;
      } 
      if($savedItems){
       return response([
           'message' => 'Updated purchase invoice',
           'success' => true,
       ]);
      }else{
        return response([
           'message' => 'No updated purchase invoice',
           'success' => false,
       ]);
      }
       
   }

   public function getPurchaseInvoiceByDate(Request $request)
{
    $request->validate([
        'StartDate' => 'required|date',
        'EndDate'   => 'required|date|after_or_equal:start_date',
    ]);
    $purchaseData = [];
    if($request->ReportMap == "Date"){
        $purchaseData = PurchaseInvoiceDetailsModel::with("product","ledger","remarks")
        ->whereBetween('EnterDate', [
        $request->StartDate,
        $request->EndDate
    ])->get();
    }else  if($request->ReportMap == "Voucher"){
      $purchaseData = PurchaseInvoiceDetailsModel::with("product","ledger")
        ->whereBetween('EnterDate', [
        $request->StartDate,
        $request->EndDate
    ])->get();
    }else  if($request->ReportMap == "Vendor"){
      $purchaseData = PurchaseInvoiceDetailsModel::with("product","ledger")
        ->whereBetween('EnterDate', [
        $request->StartDate,
        $request->EndDate
    ])
     ->where('LedgerId', $request->LedgerId)
    ->get();
       
    }else  if($request->ReportMap == "Product"){
      $purchaseData = PurchaseInvoiceDetailsModel::with("product","ledger")
        ->whereBetween('EnterDate', [
        $request->StartDate,
        $request->EndDate
    ])
     ->where('ProductId', $request->ProductId)
    ->get();
    }else  if($request->ReportMap == "Group"){
      $purchaseData = PurchaseInvoiceDetailsModel::with("product","ledger","category","subCategory")
        ->whereBetween('EnterDate', [
        $request->StartDate,
        $request->EndDate
    ])
     ->where('ProductGrpId', $request->CategoryId)
    ->get();
    }else  if($request->ReportMap == "Sub Group"){
      $purchaseData = PurchaseInvoiceDetailsModel::with("product","ledger","category","subCategory")
        ->whereBetween('EnterDate', [
        $request->StartDate,
        $request->EndDate
    ])
     ->where('ProductSubGrpId', $request->ProductSubGrpId)
    ->get();
    }

    if ($purchaseData->isNotEmpty()) {
        return response()->json([
            'message' => 'Purchase invoices retrieved successfully.',
            'success' => true,
            'data' => $purchaseData
        ]);
    } else {
        return response()->json([
            'message' => 'No purchase invoices found in the given date range.',
            'success' => false,
            'data' => []
        ]);
    }
}


  public function deletePurchaseInvoiceDetails(Request $request,$voucherNo)
    {
    try {
        if (!$voucherNo) {
            return response([
                'message' => 'VoucherNo is required',
                'success' => false,
            ], 400);
        }
        // Delete the record
        $deletePIM = PurchaseInvoiceDetailsModel::where("VoucherNo", $voucherNo)->delete();
        if ($deletePIM) {
            return response([
                'message' => 'Purchase invoice details deleted successfully.',
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

public function getVoucher(Request $request)
{
    $vouchers = PurchaseInvoiceDetailsModel::select('VoucherNo')
        ->distinct()
        ->get();
    
    return response()->json([
        'message' => 'Distinct vouchers fetched successfully.',
        'success' => true,
        'data' => $vouchers
    ], 200);
}

public function getProductByVoucherNo($voucherNo)
{
    $vouchersProduct = PurchaseInvoiceDetailsModel::with("product","category","subCategory","ledger")
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




public function ledgerVendorDetails(Request $request)
{
    $ledgerSummaries = DB::table('general_ledger')
        ->leftJoin('purchase_invoice_details', 'general_ledger.LedgerId', '=', 'purchase_invoice_details.LedgerId')
        ->select(
            'general_ledger.LedgerId as ledger_id',
            'general_ledger.GlDesc as ledger_name','general_ledger.GlCategory as ledger_category', // Or whatever columns you have
            DB::raw('COALESCE(SUM(purchase_invoice_details.BasicAmount), 0) as total_amount')
        )
        ->where("general_ledger.GlCategory","Vendor")
         ->orderByDesc('total_amount') // ✅ Sort by total_amount descending
        ->limit(10)
        ->groupBy('general_ledger.LedgerId', 'general_ledger.GlDesc','general_ledger.GlCategory')
        ->get();

    return response()->json([
        'message' => 'Ledger details fetched successfully.',
        'success' => true,
        'data' => $ledgerSummaries
    ], 200);
}

}
