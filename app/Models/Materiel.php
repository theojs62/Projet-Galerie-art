<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Attributes as OA;

#[OA\Schema(schema:"Materiel", properties: [
])]
/**
 * App\Models\Materiel
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Reservation[] $reservations
 * @property-read int|null $reservations_count
 * @property-read \App\Models\Salle|null $salle
 * @method static \Illuminate\Database\Eloquent\Builder|Materiel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Materiel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Materiel query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $designation
 * @property string $observation
 * @property int $salle_id
 * @method static \Illuminate\Database\Eloquent\Builder|Materiel whereDesignation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Materiel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Materiel whereObservation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Materiel whereSalleId($value)
 * @property string $reference
 * @method static \Database\Factories\MaterielFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Materiel whereReference($value)
 */
class Materiel extends Model {
    use HasFactory;

    public $timestamps = false;

    public function salle() {
        return $this->belongsTo(Salle::class);
    }

    public function reservations() {
        return $this->belongsToMany(Reservation::class, 'accessoires');
    }
}
