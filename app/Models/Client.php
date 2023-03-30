<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Attributes as OA;


#[OA\Schema(schema:"Client", properties: [
    new OA\Property(property: "nom", type: "string"),
    new OA\Property(property: "prenom", type: "string"),
    new OA\Property(property: "adresse", type: "string"),
    new OA\Property(property: "code_postal", type: "number"),
    new OA\Property(property: "ville", type: "string"),
])]
/**
 * App\Models\Client
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Client newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $nom
 * @property string $prenom
 * @property string $adresse
 * @property string $code_postal
 * @property string $ville
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereAdresse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereCodePostal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client wherePrenom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereVille($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Reservation[] $reservations
 * @property-read int|null $reservations_count
 * @property int|mixed $valide
 * @property int|mixed $user_id
 * @method static \Database\Factories\ClientFactory factory(...$parameters)
 * @method static findOrFail(int $id)
 */
class Client extends Model {
    use HasFactory;
    protected $fillable = ['nom', 'prenom', 'adresse', 'code_postal', 'ville','user_id','valide'];

    public function reservations() {
        return $this->hasMany(Reservation::class);
    }

    public function user() {
        return $this->hasOne(User::class);
    }
}
