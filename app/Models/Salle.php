<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Attributes as OA;

#[OA\Schema(schema:"Salle", properties: [
    new OA\Property(property: "id", type: "integer", format: "int64"),
    new OA\Property(property: "nom", type: "string"),
    new OA\Property(property: "adresse", type: "string"),
    new OA\Property(property: "code_postal", type: "number"),
    new OA\Property(property: "ville", type: "string"),
])]
/**
 * App\Models\Salle
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Activite[] $activites
 * @property-read int|null $activites_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Materiel[] $materiels
 * @property-read int|null $materiels_count
 * @method static \Illuminate\Database\Eloquent\Builder|Salle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Salle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Salle query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $nom
 * @property string $adresse
 * @property string $code_postal
 * @property string $ville
 * @property mixed $prenom
 * @property int|mixed $valide
 * @method static \Illuminate\Database\Eloquent\Builder|Salle whereAdresse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salle whereCodePostal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salle whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salle whereVille($value)
 * @method static \Database\Factories\SalleFactory factory(...$parameters)
 * @method static findOrFail(int $id)
 */
class Salle extends Model {
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'nom', 'adresse', 'code_postal', 'ville'
    ];

    public function activites() {
        return $this->hasMany(Activite::class);
    }

    public function materiels() {
        return $this->hasMany(Materiel::class);
    }
}
