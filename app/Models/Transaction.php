<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = [];

    const types = [
        'checked_in_room',
        'food',
        'laundry',
        'load',
        'extension',
        'amenities',
        'beverage',
        'damage',
    ];

    const CHECKED_IN_ROOM = 'checked_in_room';

    const FOOD = 'food';

    const LAUNDRY = 'laundry';

    const LOAD = 'load';

    const EXTENSION = 'extension';

    const AMENITIES = 'amenities';

    const BEVERAGE = 'beverage';

    const DAMAGE = 'damage';

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
