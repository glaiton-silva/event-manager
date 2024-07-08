<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Event extends Model
{
    use HasFactory;

    /**
     * Os atributos que são mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image',
        'event_date',
        'name',
        'responsible',
        'city',
        'state',
        'address',
        'number',
        'complement',
        'phone',
    ];

    /**
     * Os atributos que devem ser convertidos para instâncias de Carbon.
     *
     * @var array
     */
    protected $dates = [
        'event_date',
    ];

    /**
     * Obtém o atributo de data do evento como uma instância de Carbon.
     *
     * @param  string  $value
     * @return \Illuminate\Support\Carbon
     */
    public function getEventDateAttribute($value)
    {
        return Carbon::parse($value);
    }
}
