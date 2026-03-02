<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function storeCategory(Request $request)
    {
        //validate fields
        

        if ($request->Tag == "NEW") {
            $attrs = $request->validate([
            'CategoryDesc' => 'required|string'
        ]);
            $category = CategoryModel::create([

                'CategoryDesc' => $attrs['CategoryDesc'],
                'Status' => $request->Status,
                'EnterBy' => $request->EnterBy,
                'EnterDate' => $request->EnterDate,
                'Gadget' => $request->Gadget,
                'CategoryImg' => $request->CategoryImg,
            ]);
            return response([
            'message' => 'Category successfully.',
            'statusCode' => 200,
            'success' => true,
            'data' => $category
        ], 200);
        }else if($request->Tag == "EDIT"){
            $attrs = $request->validate([
            'CategoryDesc' => 'required|string'
        ]);
        $updated = CategoryModel::where('CategoryId', operator: $request->CategoryId)
            ->update(['CategoryDesc' => $request->CategoryDesc]);

        if ($updated) {
            return response([
                'message' => 'Category description updated successfully',
                'success' => true,
            ]);
        } else {
            return response([
                'message' => 'No changes made or category not ',
                'success' => false,
            ], 400);
        }
        }else if($request->Tag == "DELETE"){
        $updated = CategoryModel::where('CategoryId', operator: $request->CategoryId)
            ->delete();

        if ($updated) {
            return response([
                'message' => 'Category description delete successfully',
                'success' => true,
            ]);
        } else {
            return response([
                'message' => 'No changes made or category not ',
                'success' => false,
            ], 400);
        }
        }



        
    }

    function getCategory()
    {
        $allCategory = CategoryModel::all();

        return response([
            'statusCode' => 200,
            'success' => true,
            'data' => $allCategory
        ], 200);
    }

    function updateCategory(Request $request)
    {
        // Update the rating using update() method
        $updated = CategoryModel::where('CategoryId', operator: $request->CategoryId)
            ->update(['CategoryDesc' => $request->CategoryDesc]);

        if ($updated) {
            return response([
                'message' => 'Category description updated successfully',
                'success' => true,
            ]);
        } else {
            return response([
                'message' => 'No changes made or category not ',
                'success' => false,
            ], 400);
        }
    }

    function deleteCategoryById(Request $request)
    {
        // Update the rating using update() method
        $updated = CategoryModel::where('CategoryId', operator: $request->CategoryId)
            ->delete();

        if ($updated) {
            return response([
                'message' => 'Category description delete successfully',
                'success' => true,
            ]);
        } else {
            return response([
                'message' => 'No changes made or category not ',
                'success' => false,
            ], 400);
        }
    }

    function updateStatusCategory(Request $request)
    {
        // Update the rating using update() method
        $updated = CategoryModel::where('CategoryId', operator: $request->CategoryId)
            ->update(['Status' => $request->Status]);

        if ($updated) {
            return response([
                'message' => 'Category status updated successfully',
                'success' => true,
            ]);
        } else {
            return response([
                'message' => 'No changes made or category not ',
                'success' => false,
            ], 400);
        }
    }



}
