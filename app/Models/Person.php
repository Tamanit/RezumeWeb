<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Person extends Model
{
    protected $table = 'Person';
    public function Staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'Staff');
    }
}
