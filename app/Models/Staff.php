<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Staff extends Model
{
    protected $table = 'Staff';
    public $timestamps = false;

    public function Vacancy(): HasMany
    {
        return $this->hasMany(Vacancy::class, );
    }

    public function Person(): HasMany
    {
        return $this->hasMany(Person::class);
    }
}
