<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Attributes as OA;

#[OA\Schema(schema:"Activite", properties: [
])]
/**
 * App\Models\Activite
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Reservation[] $reservations
 * @property-read int|null $reservations_count
 * @property-read \App\Models\Salle|null $salle
 * @method static \Illuminate\Database\Eloquent\Builder|Activite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Activite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Activite query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $salle_id
 * @property string $sport
 * @property string $localisation
 * @method static \Illuminate\Database\Eloquent\Builder|Activite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activite whereLocalisation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activite whereSalleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activite whereSport($value)
 * @method static \Database\Factories\ActiviteFactory factory(...$parameters)
 */
class Activite extends Model {
    use HasFactory;
    public $timestamps = false;

    protected $casts = [
        'disponibilites' => 'array'
    ];

    public function salle() {
        return $this->belongsTo(Salle::class);
    }

    public function reservations() {
        return $this->hasMany(Reservation::class);
    }
}
