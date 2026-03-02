<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UnitModel;
use Illuminate\Http\Request;

class UnitController extends Controller
{


    function storeUnit(Request $request)
    {
        try {
            if ($request->Tag == "NEW") {
                $attrs = $request->validate([
                    'UnitDesc' => 'required|string'
                ]);
                $unit = UnitModel::create([
                    'UnitDesc' => $attrs['UnitDesc'],
                    'Status' => $request->Status,
                    'EnterBy' => $request->EnterBy,
                    'EnterDate' => $request->EnterDate,
                ]);

                if ($unit) {
                    return response([
                        'message' => 'Unit save successfully.',
                        'success' => true,
                        'data' => $unit
                    ], 200);
                } else {
                    return response([
                        'message' => 'Unit not save.',
                        'success' => false,
                        'data' => []
                    ], 200);
                }
            } else if ($request->Tag == "EDIT") {
                $updated = UnitModel::where('UnitId', operator: $request->UnitId)
                    ->update([
                        'UnitDesc' => $request->UnitDesc,
                    ]);

                if ($updated) {
                    return response([
                        'message' => 'Unit updated successfully',
                        'success' => true,
                    ]);
                } else {
                    return response([
                        'message' => 'No changes made or unit not ',
                        'success' => false,
                    ], 400);
                }
            } else if ($request->Tag == "DELETE") {
                $delete = UnitModel::where('UnitId', $request->UnitId)
                    ->delete();

                if ($delete) {
                    return response([
                        'message' => "Unit delete successfully",
                        'statusCode' => 200,
                        'success' => true,

                    ], 200);
                } else {
                    return response([
                        'statusCode' => 401,
                        'success' => false,

                    ], 200);
                }
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to fetch unit.',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    function getUnit()
    {
        $allUnit = UnitModel::all();

        if ($allUnit) {
            return response([
                'message' => 'Unit fetch successfully.',
                'success' => true,
                'data' => $allUnit
            ], 200);
        } else {
            return response([
                'message' => 'Record no found.',
                'success' => false,
                'data' => []
            ], 200);
        }
    }
    function deleteUnitById(Request $request)
    {
        $delete = UnitModel::where('UnitId', $request->UnitId)
            ->delete();

        if ($delete) {
            return response([
                'message' => "Unit delete successfully",
                'statusCode' => 200,
                'success' => true,

            ], 200);
        } else {
            return response([
                'statusCode' => 401,
                'success' => false,

            ], 200);
        }
    }


    function updateUnit(Request $request)
    {

        $updated = UnitModel::where('UnitId', operator: $request->UnitId)
            ->update([
                'UnitDesc' => $request->UnitDesc,
            ]);

        if ($updated) {
            return response([
                'message' => 'Unit updated successfully',
                'success' => true,
            ]);
        } else {
            return response([
                'message' => 'No changes made or unit not ',
                'success' => false,
            ], 400);
        }
    }

    function updateStatusUnit(Request $request)
    {
        // Update the rating using update() method
        $updated = UnitModel::where('UnitId', operator: $request->UnitId)
            ->update(['Status' => $request->Status]);
        if ($updated) {
            return response([
                'message' => 'Unit status updated successfully',
                'success' => true,
            ]);
        } else {
            return response([
                'message' => 'No changes made or ledger not ',
                'success' => false,
            ], 400);
        }
    }
}
