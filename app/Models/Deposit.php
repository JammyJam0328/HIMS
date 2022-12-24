<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'frontdesks' => AsCollection::class,
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }
}
