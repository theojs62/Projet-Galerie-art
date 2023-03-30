<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class SalleResource extends JsonResource
{

    /**
     * Transformer la ressource en un tableau.
     *
     * @param  Request  $request
     *
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'adresse' => $this->adresse,
            'code_postal' => $this->code_postal,
            'ville' => $this->ville
        ];
    }
    }
