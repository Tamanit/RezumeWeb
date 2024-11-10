<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Exception;

class Person extends Model
{
    protected $table = 'Person';
    public function Staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'Staff');
    }

    /**
     * @throws Exception "Stage not set" if isset($this->Stage) == false
     */
    public function getFormatedStage(): string
    {
        if (!isset($this->Stage)) {
            throw new Exception('Stage not set');
        }
        return $this->Stage . $this->num2word($this->Stage, [' год', ' года', ' лет']);
    }

    /**
     * @throws Exception "Phone not set" if isset($this->Stage) == false
     */
    public function getMaskedPhone(): string
    {
        if (!isset($this->Phone)) {
            throw new Exception('Phone not set');
        }

        $regMatch = [];
        preg_match_all('/\d/', $this->Phone, $regMatch);
        if (count($regMatch[0]) == 6) {
           return $regMatch[0][0] . $regMatch[0][1] . '-' . $regMatch[0][2] . $regMatch[0][3] . '-' . $regMatch[0][4] . $regMatch[0][5];
        }
        return $this->Phone;
    }

    protected function num2word($num, $words): string
    {
        $num = $num % 100;
        if ($num > 19) {
            $num = $num % 10;
        }
        return match ($num) {
            1 => $words[0],
            2, 3, 4 => $words[1],
            default => $words[2],
        };
    }
}
