<?php

namespace App\PetManager\controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePetRequest;
use App\PetManager\dto\PetDTO;
use App\PetManager\interfaces\PetServiceContract;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class PetManagementController extends Controller
{
    public function __construct(
        protected PetServiceContract  $petService
    ){}

    public function store(StorePetRequest $request) : JsonResponse {
        $pet = $this->petService
        ->PetRegistrationService(PetDTO::ValidatePetAttributes($request));
        return response()->json([
            'message' => 'Pet created successfully',
            'data' => $pet
        ], ResponseAlias::HTTP_CREATED);
    }
}
