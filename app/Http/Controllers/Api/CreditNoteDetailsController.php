<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CreditNoteDetails;
use Illuminate\Http\Request;

class CreditNoteDetailsController extends Controller
{



     // get all Debit Note
     public function index()
     {
        // Fetch all Prduct
        $generalLedger = CreditNoteDetails::select(
         'credit_note_details.*',
         'general_ledger.GlDesc'
        )
        ->join('general_ledger','general_ledger.LedgerId', '=', 'credit_note_details.LedgerId')
        ->get();
        if($generalLedger){
        return response([
            'message' => 'Credit Note All.',
            'statusCode' => 200,
            'status' => true,
            'data' => $generalLedger
        ], 200);
    }else{
        return response([
            'message' => 'Product Group no.',
            'statusCode' => 400,
            'status' => false,
        ], 200);
    }

     }

    public function store(Request $request)
    {
        //validate fields
        $attrs = $request->validate([
            'Amount' => 'required|integer',
            'EntryDate' => 'required'

        ]);

          $debitNotes =  CreditNoteDetails::create([
            'LedgerId' =>$request->LedgerId,
            'Narration' =>$request->Narration,
            'Amount' => $attrs['Amount'],
            'EntryDate' => $attrs['EntryDate'],

        ]);

        return response([
            'message' => 'Credit note successfully.',
            'statusCode' => 200,
            'status' => true,
            'data' => $debitNotes
        ], 200);
    }

    public function updateCreditNote(Request $request,$voucherNo)
    {
        //validate fields
        $attrs = $request->validate([
             'Amount' => 'required',
            'EntryDate' => 'required'
        ]);
    //
        $generalLedger = CreditNoteDetails::Where('VoucherNo',$voucherNo)->first();
       $generalLedger->update([
        'LedgerId' =>$request->LedgerId,
        'Narration' =>$request->Narration,
        'Amount' => $attrs['Amount'],
        'EntryDate' => $attrs['EntryDate'],
  ]);

  // Return a response
  return response([
    'message' => 'Debit  updated successfully.',
    'statusCode' => 200,
    'status' => true,
], 200);

    }
     //delete Debit note
     public function deleteCreditNote($voucherNo)
     {
        CreditNoteDetails::Where('VoucherNo',$voucherNo)
         ->delete();
         return response([
             'message' => 'Credit Note deleted.',
             'statusCode' => 200,
             'status' => true,
         ], 200);
     }
}
