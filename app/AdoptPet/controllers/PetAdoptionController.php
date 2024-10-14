<?php

namespace App\AdoptPet\controllers;

use App\AdoptPet\interfaces\PetAdoptionServiceContract;
use App\Http\Controllers\Controller;
use App\Models\PetEntry;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class PetAdoptionController extends Controller
{
    public function __construct(
        protected PetAdoptionServiceContract  $petAdoptionServiceContract
    ){}

    public function index(): JsonResponse
    {
        $pet_available = $this->petAdoptionServiceContract->listAvailableAnimals();
        return response()->json([
            'message' => 'List of available animals for adoption retrieved successfully.',
            'data' => $pet_available
        ], ResponseAlias::HTTP_OK);
    }

    public function show(string $id): JsonResponse
    {
        $pet_details = $this->petAdoptionServiceContract->fetchAnimalDetails($id);
        return response()->json([
            'message' => 'Animal details retrieved successfully.',
            'data' => $pet_details
        ], ResponseAlias::HTTP_OK);
    }
    public function adoptAnimal(string $id): JsonResponse
    {
        $adoption_pet = $this->petAdoptionServiceContract->handleAdoption($id);
        return response()->json([
            'message' => 'Animal adopted successfully.',
            'data' => $adoption_pet
        ], ResponseAlias::HTTP_CREATED);
    }
}
