<?php

namespace App\Http\Controllers;

use \Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index(): View
    {
        $header = 'Резюме и вакансии';
        return view("page", compact("header"));
    }

    public function show(): View
    {
        $header = 'Резюме и вакансии';
        $users = DB::table('Person')->get();
        foreach ($users as $user) {
            $user->Staff = DB::table('Staff')->where('Staff.id', '=', $user->Staff)->first()->staff;
            $user->Stage .= " " . $this->num2word($user->Stage, ['год', 'года', 'лет']);
            $regMatch = [];
            preg_match_all('/\d/', $user->Phone, $regMatch);
            if (count($regMatch[0]) == 6) {
                $user->Phone = $regMatch[0][0] . $regMatch[0][1] . '-' . $regMatch[0][2] . $regMatch[0][3] . '-' . $regMatch[0][4] . $regMatch[0][5];
            }
        }

        return view("resume", compact("users", "header"));
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
