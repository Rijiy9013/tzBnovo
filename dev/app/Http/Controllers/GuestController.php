<?php

namespace App\Http\Controllers;

use App\Http\Resources\GuestResource;
use App\Services\Interfaces\GuestServiceInterface;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Routing\Controller;

/**
 * @OA\Info(title="Guest API", version="1.0.0")
 *
 * @OA\Get(
 *     path="/api/v1/guests",
 *     summary="Get list of guests",
 *     tags={"Guests"},
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/GuestResource"))
 *     )
 * )
 *
 * @OA\Get(
 *     path="/api/v1/guests/paginate",
 *     summary="Get paginated list of guests",
 *     tags={"Guests"},
 *     @OA\Parameter(
 *         name="perPage",
 *         in="query",
 *         description="Number of guests per page",
 *         required=false,
 *         @OA\Schema(type="integer", default=15)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/GuestResource"))
 *     )
 * )
 *
 * @OA\Post(
 *     path="/api/v1/guests",
 *     summary="Create a new guest",
 *     tags={"Guests"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/Guest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Guest created",
 *         @OA\JsonContent(ref="#/components/schemas/GuestResource")
 *     )
 * )
 *
 * @OA\Get(
 *     path="/api/v1/guests/{uuid}",
 *     summary="Get guest by UUID",
 *     tags={"Guests"},
 *     @OA\Parameter(
 *         name="uuid",
 *         in="path",
 *         description="UUID of guest to return",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(ref="#/components/schemas/GuestResource")
 *     )
 * )
 *
 * @OA\Put(
 *     path="/api/v1/guests/{uuid}",
 *     summary="Update existing guest",
 *     tags={"Guests"},
 *     @OA\Parameter(
 *         name="uuid",
 *         in="path",
 *         description="UUID of guest to update",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/Guest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Guest updated",
 *         @OA\JsonContent(ref="#/components/schemas/GuestResource")
 *     )
 * )
 *
 * @OA\Delete(
 *     path="/api/v1/guests/{uuid}",
 *     summary="Delete a guest",
 *     tags={"Guests"},
 *     @OA\Parameter(
 *         name="uuid",
 *         in="path",
 *         description="UUID of guest to delete",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\Response(
 *         response=204,
 *         description="No content"
 *     )
 * )
 */
class GuestController extends BaseController
{
    public function __construct(GuestServiceInterface $service)
    {
        parent::__construct($service);
    }

    protected function resourceCollection($data): ResourceCollection
    {
        return GuestResource::collection($data);
    }
}
