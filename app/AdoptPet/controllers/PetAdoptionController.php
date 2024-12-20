<?php

namespace App\AdoptPet\controllers;

use App\AdoptPet\dto\adoptFormDTO;
use App\AdoptPet\interfaces\PetAdoptionServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdoptionInterestRequest;
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
    public function adoptAnimal(AdoptionInterestRequest $request,string $id): JsonResponse
    {
        $adoption_pet = $this->petAdoptionServiceContract->handleAdoption(adoptFormDTO::FromArrayValidated($request),$id);
        return response()->json([
            'message' => 'adoption ready for analysis.',
            'data' => $adoption_pet
        ], ResponseAlias::HTTP_CREATED);
    }

    public function favorite(PetEntry $id): JsonResponse
    {
        $favorite = $this->petAdoptionServiceContract->markAnimalAsFavorite($id);
        return response()->json([
            'message' => 'Animal favorite successfully.',
            'data' => $favorite
        ], ResponseAlias::HTTP_CREATED);
    }
    public function unfavorite(PetEntry $id): JsonResponse
    {
        $unfavorite = $this->petAdoptionServiceContract->removeFavoriteAnimal($id);
        return response()->json([
            'message' => 'Animal unfavorite successfully.',
            'data' => $unfavorite
        ], ResponseAlias::HTTP_CREATED);
    }

    public function showFavoriteAnimals(): JsonResponse
    {
        $collection = $this->petAdoptionServiceContract->displayFavoriteAnimals();
        return response()->json([
            'message' => 'List of favorite animals for adoption retrieved successfully.',
            'data' => $collection
        ]);
    }
    public function pendingAdoptions(): JsonResponse
    {
        $collection = $this->petAdoptionServiceContract->displayPendingAdoptions();
        return response()->json([
            'message' => 'List of pending adoptions retrieved successfully.',
            'data' => $collection
        ]);
    }
}
