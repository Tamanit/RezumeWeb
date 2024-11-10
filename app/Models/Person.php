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
        if (isset($this->Staff)) {
            return $this->belongsTo(Staff::class, 'Staff');
        }
        return $this->belongsTo(Staff::class);
    }

    public function getFormatedStage(): string|null
    {
        if (!isset($this->Stage)) {
            return null;
        }
        return $this->Stage . $this->num2word($this->Stage, [' год', ' года', ' лет']);
    }

    public function getMaskedPhone(): string|null
    {
        if (!isset($this->Phone)) {
            return null;
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

    public static function mapFromArray(array $array): Person
    {
        $person = new Person();
        if (array_key_exists('id', $array)) {
            $person->id = $array['id'];
        }
        if (array_key_exists('FIO', $array)) {
            $person->FIO = $array['FIO'];
        }
        if (array_key_exists('Staff', $array)) {
            $person->Staff = $array['Staff'];
        }
        if (array_key_exists('Phone', $array)) {
            $person->Phone = $array['Phone'];
        }
        if (array_key_exists('Stage', $array)) {
            $person->Stage = $array['Stage'];
        }
        if (array_key_exists('Image', $array)) {
            $person->Image = $array['Image'];
        }

        return $person;
    }
}
