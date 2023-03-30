<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Attributes as OA;

#[OA\Schema(schema:"Reservation", properties: [
])]
/**
 * App\Models\Reservation
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Materiel[] $accessoires
 * @property-read int|null $accessoires_count
 * @property-read \App\Models\Activite|null $activites
 * @property-read \App\Models\Client|null $client
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $intitule
 * @property string $debut
 * @property string $fin
 * @property int $participants
 * @property int $client_id
 * @property int $activite_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereActiviteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereDebut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereIntitule($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereParticipants($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereUpdatedAt($value)
 * @method static \Database\Factories\ReservationFactory factory(...$parameters)
 */
class Reservation extends Model {
    use HasFactory;

    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function activite() {
        return $this->belongsTo(Activite::class);
    }

    public function accessoires() {
        return $this->belongsToMany(Materiel::class, "accessoires");
    }
}
