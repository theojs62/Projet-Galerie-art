<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SalleRequest;
use App\Http\Resources\SalleResource;
use App\Models\Salle;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use OpenApi\Attributes as OA;

class SalleController extends Controller
{
    #[OA\Get(
        path: "/salles",
        operationId: "index",
        description: "La liste des salles",
        tags: ["Salles"],
        responses: [
            new OA\Response(response: 200,
                description: "La liste des salles",
                content: new OA\JsonContent(type: "array", items: new OA\Items(properties: [
                    new OA\Property(property: "id", type: "integer", format: "int64"),
                    new OA\Property(property: "nom", type: "string"),
                    new OA\Property(property: "adresse", type: "string"),
                    new OA\Property(property: "code_postal", type: "number"),
                    new OA\Property(property: "ville", type: "string"),
                ], type: "object"))
            ),
        ]
    )]
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $full = $request->get('full', false);
        if ($full)
            $salles = Salle::with('activites')->get();
        else
            $salles = Salle::all();
        return SalleResource::collection($salles);
    }


    #[OA\Post(
        path: "/salles",
        operationId: "create",
        description: "Ajouter une salle dans la base",
        requestBody: new OA\RequestBody(
            required: true,
        ),
        tags: ["Salles"],
        responses: [new OA\Response(response: 200,
            description: "Creation d'une salles",
            content: new OA\JsonContent(properties: [
                new OA\Property(property: "status", type: "boolean"),
                new OA\Property(property: "message", type: "string"),
                new OA\Property(property: "salle")
            ], type: "object")),
            new OA\Response(response: 422,
                description: "Creation d'une salle",
                content: new OA\JsonContent(properties: [
                    new OA\Property(property: "message", type: "string"),
                    new OA\Property(property: "errors", properties: [
                        new OA\Property(property: "nom|adresse|code_postal|ville", type: "array", items: new OA\Items(type: "string"))
                    ], type: "object"
                    ),
                ], type: "object"))
        ],
    )]
    /**
     * Store a newly created resource in storage.
     *
     * @param SalleRequest $request
     * @return JsonResponse
     */
    public function store(SalleRequest $request): JsonResponse
    {
        $salle = new Salle();
        $salle->nom = $request['nom'];
        $salle->adresse = $request['adresse'];
        $salle->code_postal = $request['code_postal'];
        $salle->ville = $request['ville'];
        $salle->save();
        return response()->json([
            'status'=> true,
            'message' => "Salle Created successfully!",
            'salle' => $salle
        ],200);
    }

    #[OA\Get(
        path: "/salles/{id}",
        operationId: "show",
        description: "Détails d'une salles",
        tags: ["Salles"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "Identifiant de la salle",
                in: "path", required: "true",
                schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(response: 200,
                description: "Détails d'une salle",
                content: new OA\JsonContent(properties: [
                    new OA\Property(property: "id", type: "integer", format: "int64"),
                    new OA\Property(property: "nom", type: "string"),
                    new OA\Property(property: "adresse", type: "string"),
                    new OA\Property(property: "code_postal", type: "number"),
                    new OA\Property(property: "ville", type: "string"),
                ], type: "object")
            ),
            new OA\Response(response: 404, description: "Salle non trouvée",
                content: new OA\JsonContent(properties: [
                    new OA\Property(property: "message", type: "string"),
                    new OA\Property(property: "errors", properties: [
                        new OA\Property(property: "id", type: "array", items: new OA\Items(type: "string"))
                    ], type: "object"
                    ),
                ], type: "object"))
        ]
    )]
    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return SalleResource
     */
    public function show(int $id): SalleResource
    {
        $salle = Salle::findOrFail($id);
        return new SalleResource($salle);
    }

    #[OA\Put(
        path: "/salles/{id}",
        operationId: "update",
        description: "Modifier une salles dans la base",
        requestBody: new OA\RequestBody(
            required: true,
        ), tags: ["Salles"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "Identifiant de la salle",
                in: "path", required: "true",
                schema: new OA\Schema(type: "integer"))
        ],
        responses: [new OA\Response(response: 200,
            description: "Modification d'une salles",
            content: new OA\JsonContent(properties: [
                new OA\Property(property: "status", type: "boolean"),
                new OA\Property(property: "message", type: "string"),
                new OA\Property(property: "personne")
            ], type: "object")),
            new OA\Response(response: 422,
                description: "Creation d'une salles",
                content: new OA\JsonContent(properties: [
                    new OA\Property(property: "message", type: "string"),
                    new OA\Property(property: "errors", type: "object"),
                ], type: "object"))
        ],
    )]
    /**
     * Update the specified resource in storage.
     *
     * @param SalleRequest $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function update(SalleRequest $request, int $id): JsonResponse
    {
        $salle = Salle::findOrFail($id);
        $salle->update($request->all());
        return response()->json([
            'status' => true,
            'message' => "La salle a été mise à jour avec succès !",
            'salle' => $salle
        ], 200);
    }

    #[OA\Delete(
        path: "/salles/{id}",
        operationId: "destroy",
        description: "Supprime une salles",
        tags: ["Salles"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "Identifiant de la salle",
                in: "path", required: "true",
                schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(response: 200,
                description: "Supprime une salle",
                content: new OA\JsonContent(properties: [
                    new OA\Property(property: "status", type: "boolean"),
                    new OA\Property(property: "message", type: "string"),
                ], type: "object")
            ),
            new OA\Response(response: 404, description: "Salle non trouvée",
                content: new OA\JsonContent(properties: [
                    new OA\Property(property: "message", type: "string"),
                    new OA\Property(property: "errors", properties: [
                        new OA\Property(property: "id", type: "array", items: new OA\Items(type: "string"))
                    ], type: "object"
                    ),
                ], type: "object"))
        ]
    )]
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy(SalleRequest $request,int $id)
    {
        $salle = Salle::findOrFail($id);
        $salle->destroy($request->all());
        return response()->json([
            'status' => true,
            'message'=> 'la salle a été supprimée.',
            'salle' => $salle
        ],200);
    }
}
