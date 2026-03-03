<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\GeneralLedgerController;
use App\Http\Controllers\Api\GodownController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\PurchaseInvoiceDetailsController;
use App\Http\Controllers\Api\PurchaseInvoiceMasterController;
use App\Http\Controllers\Api\SalesInvoiceDetailsController;
use App\Http\Controllers\Api\SalesInvoiceMasterController;
use App\Http\Controllers\Api\SubCategoryController;
use App\Http\Controllers\Api\UnitController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//php artisan serve --host=0.0.0.0 --port=8000
//php artisan serve --host=ipconfig --port=8000
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

 // category save 
   Route::post('/storeCategory', [CategoryController::class, 'storeCategory']); // 
   Route::get('/getCategory', [CategoryController::class, 'getCategory']); // all 
   Route::post('/updateCategory/{CategoryId}', [CategoryController::class, 'updateCategory']); // all updateCategorydeleteCategoryById
   Route::delete('/deleteCategoryById/{CategoryId}', [CategoryController::class, 'deleteCategoryById']); // all updateCate 
    Route::post('/updateStatusCategory/{CategoryId}', [CategoryController::class, 'updateStatusCategory']); // all updateCate 

    //Sub Category  
    Route::post('/storeSubCategory', [SubCategoryController::class, 'storeSubCategory']); //
    Route::get('/getSubCategory', [SubCategoryController::class, 'getSubCategory']); //
    Route::get('/getCateSubAll', [SubCategoryController::class, 'getCateSubAll']); //
    Route::delete('/deleteSubCategoryById/{ProductSubGrpId}', [SubCategoryController::class, 'deleteSubCategoryById']); // all updateCate 
    Route::post('/updateStatusSubCategory/{ProductSubGrpId}', [SubCategoryController::class, 'updateStatusSubCategory']); // all updateCate 
      Route::post('/updateSubCategory/{ProductSubGrpId}', [SubCategoryController::class, 'updateSubCategory']); // all updateCategorydeleteCategoryById

    //ledger     
    Route::post('/storeLedger', [GeneralLedgerController::class, 'storeLedger']); //
     Route::get('/getLedgerVendor', [GeneralLedgerController::class, 'getLedgerVendor']); //
     Route::get('/getLedgerCustomer', [GeneralLedgerController::class, 'getLedgerCustomer']); //
     Route::get('/getLedger', [GeneralLedgerController::class, 'getLedger']); //
     Route::post('/updateLedger/{LedgerId}', [GeneralLedgerController::class, 'updateLedger']); //
     Route::delete('/deleteLedgerById/{LedgerId}', [GeneralLedgerController::class, 'deleteLedgerById']); //
     Route::post('/updateStatusLedger/{LedgerId}', [GeneralLedgerController::class, 'updateStatusLedger']); //

     //Unit      
      Route::post('/storeUnit', [UnitController::class, 'storeUnit']); //
      Route::get('/getUnit', [UnitController::class, 'getUnit']);
      Route::delete('/deleteUnitById/{UnitId}', [UnitController::class, 'deleteUnitById']);
      Route::post('/updateUnit/{UnitId}', [UnitController::class, 'updateUnit']);
      Route::post('/updateStatusUnit/{UnitId}', [UnitController::class, 'updateStatusUnit']);
 
      //Godown    updateGodown
       Route::post('/storeGodown', [GodownController::class, 'storeGodown']); //
       Route::get('/getGodown', [GodownController::class, 'getGodown']); //
        Route::delete('/deleteGodownById/{GodownId}', [GodownController::class, 'deleteGodownById']);
         Route::post('/updateGodown/{GodownId}', [GodownController::class, 'updateGodown']);
        Route::post('/updateStatusGodown/{GodownId}', [GodownController::class, 'updateStatusGodown']);

        //Product    
       Route::post('/storeProduct', [ProductController::class, 'storeProduct']); //
       Route::get('/getProduct', [ProductController::class, 'getProduct']); //

       //Purchase storePurchaseMaster
        Route::post('/storePurchaseMaster', [PurchaseInvoiceMasterController::class, 'storePurchaseMaster']); //
        Route::get('/generateVoucherNumber', [PurchaseInvoiceMasterController::class, 'generateVoucherNumber']); //
        Route::delete('/deletePurchaseInvoiceMaster/{VoucherNo}', [PurchaseInvoiceMasterController::class, 'deletePurchaseInvoiceMaster']); //
         Route::post('/updatePurchaseMaster', [PurchaseInvoiceMasterController::class, 'updatePurchaseMaster']); //
          Route::get('/getPurchaseInvoiceMasterByVoucherNo/{VoucherNo}', [PurchaseInvoiceMasterController::class, 'getPurchaseInvoiceMasterByVoucherNo']); //

        //Purchase storePurchaseDetails     
        Route::post('/storePurchaseDetails2/{VoucherNo}', [PurchaseInvoiceDetailsController::class, 'storePurchaseDetails2']); //
        Route::get('/getVoucher', [PurchaseInvoiceDetailsController::class, 'getVoucher']); //
        Route::get('/getProductByVoucherNo/{VoucherNo}', [PurchaseInvoiceDetailsController::class, 'getProductByVoucherNo']); //
        Route::delete('/deletePurchaseInvoiceDetails/{VoucherNo}', [PurchaseInvoiceDetailsController::class, 'deletePurchaseInvoiceDetails']); //
         Route::post('/updatePurchaseInvoiceDetails/{VoucherNo}', [PurchaseInvoiceDetailsController::class, 'updatePurchaseInvoiceDetails']); //
          Route::post('/getPurchaseInvoiceByDate', [PurchaseInvoiceDetailsController::class, 'getPurchaseInvoiceByDate']); //
          Route::get('/ledgerVendorDetails', [PurchaseInvoiceDetailsController::class, 'ledgerVendorDetails']); //
         


          //Sales invoce storeSalesInvoiceDetails 
          Route::get('/generateSalesInvoiceVoucherNumber', [SalesInvoiceMasterController::class, 'generateSalesInvoiceVoucherNumber']); //
        Route::post('/storeSalesInvoiceMaster', [SalesInvoiceMasterController::class, 'storeSalesInvoiceMaster']); //
        Route::delete('/deleteSalesInvoiceMaster/{VoucherNo}', [SalesInvoiceMasterController::class, 'deleteSalesInvoiceMaster']); //
        Route::post('/updateSalesInvoiceMaster', [SalesInvoiceMasterController::class, 'updateSalesInvoiceMaster']); //
         Route::get('/getSalesInvoiceMasterByVoucherNo/{VoucherNo}', [SalesInvoiceMasterController::class, 'getSalesInvoiceMasterByVoucherNo']); //
         Route::get('/getSalesInvoiceMasterLimit10', [SalesInvoiceMasterController::class, 'getSalesInvoiceMasterLimit10']); //

        //Sales invoce detals  
         Route::post('/storeSalesInvoiceDetails/{voucherNo}', [SalesInvoiceDetailsController::class, 'storeSalesInvoiceDetails']); //
         Route::get('/getSalesInvoiceVoucher', [SalesInvoiceDetailsController::class, 'getSalesInvoiceVoucher']); //
         
         Route::Delete('/deleteSalesInvoiceDetails/{VoucherNo}', [SalesInvoiceDetailsController::class, 'deleteSalesInvoiceDetails']); //
         Route::post('/updateSalesInvoiceDetails/{VoucherNo}', [SalesInvoiceDetailsController::class, 'updateSalesInvoiceDetails']); //
         Route::get('/getProductSalesInvoiceByVoucherNo/{VoucherNo}', [SalesInvoiceDetailsController::class, 'getProductSalesInvoiceByVoucherNo']); //
          Route::get('/ledgerCustomerDetails', [SalesInvoiceDetailsController::class, 'ledgerCustomerDetails']); //
          Route::get('/getSalesInvoiceToday/{VoucherNo}', [SalesInvoiceDetailsController::class, 'getSalesInvoiceToday']); //
