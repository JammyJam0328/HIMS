<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = [];

    const TYPES = [
        'frontdesk' => 'Frontdesk',
        'manager' => 'Manager',
        'staff' => 'Staff',
        'room_boy' => 'Room Boy',
    ];

    const FRONTDESK = 'frontdesk';

    const MANAGER = 'manager';

    const STAFF = 'staff';

    const ROOM_BOY = 'room_boy';

    public function frontdesks()
    {
        return $this->hasMany(Frontdesk::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
