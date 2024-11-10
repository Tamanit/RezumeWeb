<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vacancy extends Model
{
    protected $table = 'Vacancy';
    public $timestamps = false;

    public function Firm(): BelongsTo
    {
        return $this->belongsTo(Firm::class, 'Firm');
    }

    public function Staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'Staff');
    }
}
