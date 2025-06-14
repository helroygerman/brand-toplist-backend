<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;




class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    /**
     * @OA\Get(
     *     path="/api/v1/brands",
     *     summary="Get list of brands",
     *     tags={"Brands"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer"),
     *                 @OA\Property(property="brand_name", type="string"),
     *                 @OA\Property(property="brand_image", type="string"),
     *                 @OA\Property(property="rating", type="integer")
     *             )
     *         )
     *     )
     * )
     */
    public function index()
    {
        //
        $brands = Brand::all();
        return response()->json($brands);
    }
    /**
     * @OA\Post(
     *     path="/api/v1/brands",
     *     summary="Create a new brand",
     *     tags={"Brands"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"brand_name","brand_image","rating"},
     *             @OA\Property(property="brand_name", type="string", example="Nike"),
     *             @OA\Property(property="brand_image", type="string", format="url", example="https://example.com/image.jpg"),
     *             @OA\Property(property="rating", type="integer", example=5)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Brand created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="brand_name", type="string"),
     *             @OA\Property(property="brand_image", type="string"),
     *             @OA\Property(property="rating", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */

   
    public function store(Request $request)
    {
        //make validation rules for the request
        $request->validate([
            'brand_name' => 'required|string|max:255',
            'brand_image' => 'required|url',
            'rating' => 'required|integer|min:0|max:5',
        ]);

        // Create a new brand using the validated data
        $brand = Brand::create([
            'brand_name' => $request->brand_name,
            'brand_image' => $request->brand_image,
            'rating' => $request->rating,
        ]);
        // Return the created brand with a 201 status code
        return response()->json($brand, 201);
    }

    /**
     * Display the specified resource.
     */

    /**
     * @OA\Get(
     *     path="/api/v1/brands/{brand_id}",
     *     summary="Get a specific brand",
     *     tags={"Brands"},
     *     @OA\Parameter(
     *         name="brand_id",
     *         in="path",
     *         required=true,
     *         description="ID of the brand",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Brand found",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="brand_name", type="string"),
     *             @OA\Property(property="brand_image", type="string"),
     *             @OA\Property(property="rating", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Brand not found"
     *     )
     * )
     */
    public function show(string $brand_id)
    {
        //
       
        $brand = Brand::where('brand_id',$brand_id)->first();
        return response()->json($brand);
    }

    /**
     * Update the specified resource in storage.
     */
    /**
     * @OA\Put(
     *     path="/api/v1/brands/{brand_id}",
     *     summary="Update a specific brand",
     *     tags={"Brands"},
     *     @OA\Parameter(
     *         name="brand_id",
     *         in="path",
     *         required=true,
     *         description="ID of the brand to update",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="brand_name", type="string", example="Adidas"),
     *             @OA\Property(property="brand_image", type="string", format="url", example="https://example.com/image.jpg"),
     *             @OA\Property(property="rating", type="integer", example=4)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Brand updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="brand_name", type="string"),
     *             @OA\Property(property="brand_image", type="string"),
     *             @OA\Property(property="rating", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Brand not found"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function update(Request $request, string $brand_id)
    {
        //
        $request->validate([
            'brand_name' => 'sometimes|required|string|max:255',
            'brand_image' => 'sometimes|required|url',
            'rating' => 'sometimes|required|integer|min:0|max:5',
        ]);
        $brand = Brand::where('brand_id', $brand_id)->firstOrFail();
        $brand->update($request->only(['brand_name', 'brand_image', 'rating']));
        return response()->json([
            'id' => $brand->brand_id,
            'brand_name' => $brand->brand_name,
            'brand_image' => $brand->brand_image,
            'rating' => $brand->rating,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */

    /**
     * @OA\Delete(
     *     path="/api/v1/brands/{brand_id}",
     *     summary="Delete a specific brand",
     *     tags={"Brands"},
     *     @OA\Parameter(
     *         name="brand_id",
     *         in="path",
     *         required=true,
     *         description="ID of the brand to delete",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Brand deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Brand not found"
     *     )
     * )
     */
    public function destroy(string $brand_id)
    {
        //
        //var_dump($brand_id);
       // die();
        
        $brand = Brand::where('brand_id',$brand_id)->first();
        $brand->delete();

        return response()->json(['message' => 'Brand deleted successfully'], 204);
    }
}
