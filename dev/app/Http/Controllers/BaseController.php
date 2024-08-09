<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\BaseServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Routing\Controller;

abstract class BaseController extends Controller
{
    protected BaseServiceInterface $service;

    public function __construct(BaseServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *     path="/api/v1/{resource}",
     *     summary="Get list of resources",
     *     @OA\Parameter(
     *         name="resource",
     *         in="path",
     *         description="Resource name",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     )
     * )
     */
    protected function index(): ResourceCollection
    {
        $data = $this->service->getAll();
        return $this->resourceCollection($data);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/{resource}/paginate",
     *     summary="Get paginated list of resources",
     *     @OA\Parameter(
     *         name="resource",
     *         in="path",
     *         description="Resource name",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="perPage",
     *         in="query",
     *         description="Number of resources per page",
     *         required=false,
     *         @OA\Schema(type="integer", default=15)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     )
     * )
     */
    protected function paginate(Request $request, int $perPage = 15): ResourceCollection
    {
        $data = $this->service->getPaginated($perPage);
        return $this->resourceCollection($data);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/{resource}",
     *     summary="Create a new resource",
     *     @OA\Parameter(
     *         name="resource",
     *         in="path",
     *         description="Resource name",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Resource created",
     *     )
     * )
     */
    protected function store(Request $request): JsonResponse
    {
        $data = $this->service->create($request->all());
        return response()->json($data, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/{resource}/{uuid}",
     *     summary="Get resource by UUID",
     *     @OA\Parameter(
     *         name="resource",
     *         in="path",
     *         description="Resource name",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="uuid",
     *         in="path",
     *         description="UUID of resource",
     *         required=true,
     *         @OA\Schema(type="string", format="uuid")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     )
     * )
     */
    protected function show(string $uuid): JsonResponse
    {
        $data = $this->service->getById($uuid);
        return response()->json($data);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/{resource}/{uuid}",
     *     summary="Update existing resource",
     *     @OA\Parameter(
     *         name="resource",
     *         in="path",
     *         description="Resource name",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="uuid",
     *         in="path",
     *         description="UUID of resource",
     *         required=true,
     *         @OA\Schema(type="string", format="uuid")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Resource updated",
     *     )
     * )
     */
    protected function update(Request $request, string $uuid): JsonResponse
    {
        $data = $this->service->update($uuid, $request->all());
        return response()->json($data);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/{resource}/{uuid}",
     *     summary="Delete a resource",
     *     @OA\Parameter(
     *         name="resource",
     *         in="path",
     *         description="Resource name",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="uuid",
     *         in="path",
     *         description="UUID of resource",
     *         required=true,
     *         @OA\Schema(type="string", format="uuid")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="No content",
     *     )
     * )
     */
    protected function destroy(string $uuid): JsonResponse
    {
        $this->service->delete($uuid);
        return response()->json(null, 204);
    }

    protected abstract function resourceCollection($data): ResourceCollection;
}
