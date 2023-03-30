<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClientResource;
use App\Jobs\ExportClientListByMessage;
use App\Models\Client;
use App\Models\Salle;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use OpenApi\Attributes as OA;

class ClientController extends Controller
{
    #[OA\Get(
        path: "/clients",
        operationId: "index",
        description: "La liste des clients",
        tags: ["Clients"],
        responses: [
            new OA\Response(response: 200,
                description: "La liste des clients",
                content: new OA\JsonContent(type: "array", items: new OA\Items(properties: [
                    new OA\Property(property: "id", type: "integer", format: "int64"),
                    new OA\Property(property: "nom", type: "string"),
                    new OA\Property(property: "prenom", type: "string"),
                    new OA\Property(property: "adresse", type: "string"),
                    new OA\Property(property: "code_postal", type: "number"),
                    new OA\Property(property: "ville", type: "string"),
                    new OA\Property(property: "valide", type: "boolean"),
                ], type: "object"))
            ),
        ]
    )]
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (strtolower($request->query('format')) === "csv" ||
            strtolower($request->query('format')) === "xls"||
            strtolower($request->query('format')) === "pdf") {
            Log::info("Clients index : ".Auth::user()."**");
            ExportClientListByMessage::dispatch(Auth::user(), strtolower($request->query('format')));
            return response()->noContent();
        }
        $clients = Client::all();
        return ClientResource::collection($clients);
    }


    #[OA\Post(
        path: "/clients",
        operationId: "create",
        description: "Ajouter un client dans la base",
        requestBody: new OA\RequestBody(
            required: true,
        ),
        tags: ["Clients"],
        responses: [new OA\Response(response: 200,
            description: "Creation d'un Client",
            content: new OA\JsonContent(properties: [
                new OA\Property(property: "status", type: "boolean"),
                new OA\Property(property: "message", type: "string"),
                new OA\Property(property: "client")
            ], type: "object")),
            new OA\Response(response: 422,
                description: "Creation d'un client",
                content: new OA\JsonContent(properties: [
                    new OA\Property(property: "message", type: "string"),
                    new OA\Property(property: "errors", properties: [
                        new OA\Property(property: "nom|prenom|adresse|code_postal|ville", type: "array", items: new OA\Items(type: "string"))
                    ], type: "object"
                    ),
                ], type: "object"))
        ],
    )]
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $user = new User();
        $user->name = $request['prenom'] . ' ' . $request['nom'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);
        $user->save();
        $client = new Client();
        $client->nom = $request['nom'];
        $client->prenom = $request['prenom'];
        $client->adresse = $request['adresse'];
        $client->code_postal = $request['code_postal'];
        $client->ville = $request['ville'];
        $client->valide = 1;
        $client->user_id = $user->id;
        $client->save();
        return response()->json([
            'status' => true,
            'message' => "Client and User created successfully!",
            'client' => $client
        ], 200);
    }

    #[OA\Get(
        path: "/clients/{id}",
        operationId: "show",
        description: "Détails d'un client",
        tags: ["Clients"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "Identifiant d'un client",
                in: "path", required: "true",
                schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(response: 200,
                description: "Détails d'un client",
                content: new OA\JsonContent(properties: [
                    new OA\Property(property: "id", type: "integer", format: "int64"),
                    new OA\Property(property: "nom", type: "string"),
                    new OA\Property(property: "prenom", type: "string"),
                    new OA\Property(property: "adresse", type: "string"),
                    new OA\Property(property: "code_postal", type: "number"),
                    new OA\Property(property: "ville", type: "string"),
                    new OA\Property(property: "valide", type: "boolean"),
                ], type: "object")
            ),
            new OA\Response(response: 404, description: "Client non trouvée",
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
     * @param  int  $id
     * @return ClientResource
     */
    public function show(int $id): ClientResource
    {
        $client = Client::findOrFail($id);
        return new ClientResource($client);
    }

    #[OA\Put(
        path: "/clients/{id}",
        operationId: "update",
        description: "Modifier un client dans la base",
        requestBody: new OA\RequestBody(
            required: true,
        ), tags: ["Clients"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "Identifiant d'un client",
                in: "path", required: "true",
                schema: new OA\Schema(type: "integer"))
        ],
        responses: [new OA\Response(response: 200,
            description: "Modification d'un client",
            content: new OA\JsonContent(properties: [
                new OA\Property(property: "status", type: "boolean"),
                new OA\Property(property: "message", type: "string"),
                new OA\Property(property: "personne")
            ], type: "object")),
            new OA\Response(response: 422,
                description: "Creation d'un client",
                content: new OA\JsonContent(properties: [
                    new OA\Property(property: "message", type: "string"),
                    new OA\Property(property: "errors", type: "object"),
                ], type: "object"))
        ],
    )]
    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $client = Client::findOrFail($id);
        $client->update($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Le client a été mise à jour avec succès !',
            'client' => $client
        ], 200);
    }

    #[OA\Delete(
        path: "/clients/{id}",
        operationId: "destroy",
        description: "Supprime un client",
        tags: ["Clients"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "Identifiant d'un client",
                in: "path", required: "true",
                schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(response: 200,
                description: "Supprime un client",
                content: new OA\JsonContent(properties: [
                    new OA\Property(property: "status", type: "boolean"),
                    new OA\Property(property: "message", type: "string"),
                ], type: "object")
            ),
            new OA\Response(response: 404, description: "Client non trouvée",
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
    public function destroy(Request $request, int $id): JsonResponse
    {
        $client = Client::findOrFail($id);
        $client->destroy($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Le client a été supprimé.',
            'client' => $client
        ], 200);
    }
}
