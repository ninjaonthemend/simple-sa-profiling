<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates = [
        'birth_date',
    ];

    protected $casts = [
        'interests' => 'array',
    ];

    public function getFullNameAttribute()
    {
        return "{$this->name} {$this->surname}";
    }
}
