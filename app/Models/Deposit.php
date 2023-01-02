<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function frontdesks()
    {
        return \json_decode($this->frontdesks);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }
}
