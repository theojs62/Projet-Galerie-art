<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use OpenApi\Attributes as OA;


#[OA\Schema(schema:"Role", properties: [
    new OA\Property(property: "nom", type: "string"),
])]
class Role extends Model
{
    use HasFactory;
    public $timestamps = false;

    /**
     * @var string[]
     *
     */
    protected $fillable = [
        'nom'
    ];

    public function clients() {
        return $this->hasMany(Client::class);
    }

}
