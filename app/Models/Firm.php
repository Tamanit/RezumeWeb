<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Firm extends Model
{
    protected $table = 'Firm';
    public $timestamps = false;

    public function Firm(): HasMany
    {
        return $this->hasMany(Firm::class);
    }
}
