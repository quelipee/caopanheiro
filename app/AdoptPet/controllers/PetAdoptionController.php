<?php

namespace App\AdoptPet\controllers;

use App\AdoptPet\interfaces\PetAdoptionServiceContract;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
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
}
