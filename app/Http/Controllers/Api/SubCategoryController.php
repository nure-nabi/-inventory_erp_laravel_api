<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SubCategoryModel;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{

    public function storeSubCategory(Request $request)
    {
        try {
            if ($request->Tag == "NEW") {
                //validate fields
                $attrs = $request->validate([
                    'ProductSubGrpDesc' => 'required|string',
                    'ProductSubGrpShortName' => 'required|string'
                ]);//
                $productSubGroup = SubCategoryModel::create([
                    'ProductSubGrpDesc' => $attrs['ProductSubGrpDesc'],
                    'ProductSubGrpShortName' => $attrs['ProductSubGrpShortName'],
                    'ProductGrpId' => $request->ProductGrpId,
                    'Status' => $request->Status,
                    'EnterBy' => $request->EnterBy,
                    'EnterDate' => $request->EnterDate,
                    'Gadget' => $request->Gadget,
                    'PSGImg' => "no",
                ]);

                if ($productSubGroup) {
                    return response([
                        'message' => 'Sub Category description updated  successfully',
                        'success' => true,
                    ]);
                } else {
                    return response([
                        'message' => 'No changes made or sub category not ',
                        'success' => false,
                    ], 400);
                }
            } else if ($request->Tag == "EDIT") {
                 $attrs = $request->validate([
                    'ProductSubGrpDesc' => 'required|string',
                    'ProductSubGrpShortName' => 'required|string'
                ]);//
                $updated = SubCategoryModel::where('ProductSubGrpId', operator: $request->ProductSubGrpId)
                    ->update([
                        'ProductSubGrpDesc' => $request->ProductSubGrpDesc,
                        'ProductSubGrpShortName' => $request->ProductSubGrpDesc
                    ]);

                if ($updated) {
                    return response([
                        'message' => 'Sub Category description updated successfully',
                        'success' => true,
                    ]);
                } else {
                    return response([
                        'message' => 'No changes made or subcategory not ',
                        'success' => false,
                    ], 400);
                }
            } else if ($request->Tag == "DELETE") {
                $deleted = SubCategoryModel::where('ProductSubGrpId', operator: $request->ProductSubGrpId)
                    ->delete();

                if ($deleted) {
                    return response([
                        'message' => 'Sub Category description delete successfully',
                        'success' => true,
                    ]);
                } else {
                    return response([
                        'message' => 'No changes made or sub category not ',
                        'success' => false,
                    ], 400);
                }
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to fetch categories with subcategories.',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    function getSubCategory()
    {
        $allSubCategory = SubCategoryModel::all();

        return response([
            'statusCode' => 200,
            'success' => true,
            'data' => $allSubCategory
        ], 200);
    }

    public function getCateSubAll(Request $request)
    {
        try {
            // Eager load the category relationship
            $subcategories = SubCategoryModel::with('category')->get();
            $groupedData = [];
            return response()->json([
                'message' => 'Categories with subcategories fetched successfully.',
                'success' => true,
                'data' => $subcategories
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to fetch categories with subcategories.',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getCateSubAll2(Request $request)
    {
        try {
            // Eager load the category relationship
            $subcategories = SubCategoryModel::with('categoryId')->get();

            $groupedData = [];

            foreach ($subcategories as $subcategory) {
                // Skip if category relationship doesn't exist
                if (!$subcategory->categoryId) {
                    continue;
                }

                $categoryId = $subcategory->categoryId->CategoryId;

                if (!isset($groupedData[$categoryId])) {
                    $groupedData[$categoryId] = [
                        'category' => $subcategory->categoryId,
                        'subcategories' => []
                    ];
                }

                $groupedData[$categoryId]['subcategories'][] = $subcategory;
            }

            // Convert associative array to indexed array
            $result = array_values($groupedData);

            return response()->json([
                'message' => 'Categories with subcategories fetched successfully.',
                'success' => true,
                'data' => $result
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to fetch categories with subcategories.',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }


    function updateSubCategory(Request $request)
    {
        // Update the rating using update() method
        $updated = SubCategoryModel::where('ProductSubGrpId', operator: $request->ProductSubGrpId)
            ->update([
                'ProductSubGrpDesc' => $request->ProductSubGrpDesc,
                'ProductSubGrpShortName' => $request->ProductSubGrpDesc
            ]);

        if ($updated) {
            return response([
                'message' => 'Sub Category description updated successfully',
                'success' => true,
            ]);
        } else {
            return response([
                'message' => 'No changes made or subcategory not ',
                'success' => false,
            ], 400);
        }
    }

    function deleteSubCategoryById(Request $request)
    {
        // Update the rating using update() method
        $deleted = SubCategoryModel::where('ProductSubGrpId', operator: $request->ProductSubGrpId)
            ->delete();

        if ($deleted) {
            return response([
                'message' => 'Sub Category description delete successfully',
                'success' => true,
            ]);
        } else {
            return response([
                'message' => 'No changes made or sub category not ',
                'success' => false,
            ], 400);
        }
    }

    function updateStatusSubCategory(Request $request)
    {
        // Update the rating using update() method
        $updated = SubCategoryModel::where('ProductSubGrpId', operator: $request->ProductSubGrpId)
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
