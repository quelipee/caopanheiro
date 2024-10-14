<?php

namespace App\PetManager\controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePetRequest;
use App\Http\Requests\UpdatePetRequest;
use App\Models\PetEntry;
use App\Models\User;
use App\PetManager\dto\PetDTO;
use App\PetManager\dto\PetUpdateDTO;
use App\PetManager\interfaces\PetServiceContract;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class PetManagementController extends Controller
{
    public function __construct(
        protected PetServiceContract  $petService
    ){}

    public function index(): JsonResponse
    {
        $pets_collection = $this->petService->fetchAllPetsCollection();
        return response()->json([
            'message' => 'List of all pets retrieved successfully.',
            'data' => $pets_collection
        ],ResponseAlias::HTTP_OK);
    }
    public function store(StorePetRequest $request): JsonResponse {
        $pet = $this->petService
        ->PetRegistrationService(PetDTO::ValidatePetAttributes($request));
        return response()->json([
            'message' => 'Pet created successfully',
            'data' => $pet
        ], ResponseAlias::HTTP_CREATED);
    }

    public function update(UpdatePetRequest $request, string $id): JsonResponse
    {
        $pet_updated = $this->petService
            ->editAnimalDetails(PetUpdateDTO::ValidatePetAttributesUpdated($request),$id);
        return response()->json([
            'message' => 'Pet updated successfully',
            'data' => $pet_updated
        ], ResponseAlias::HTTP_CREATED);
    }

    public function destroy(string $id): JsonResponse
    {
        $pet = $this->petService->removePetById($id);
        return response()->json([
            'message' => 'Pet deleted successfully',
            'data' => $pet
        ], ResponseAlias::HTTP_NO_CONTENT);
    }
    public function completeAdoption(PetEntry $pet, User $user): JsonResponse
    {
        $adopted = $this->petService->finalizeAdoption($pet, $user);
        return response()->json([
            'message' => 'Adoption completed successfully',
            'data' => $adopted
        ], ResponseAlias::HTTP_CREATED);
    }
}
