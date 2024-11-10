<?php

namespace App\Http\Controllers;

use App\Models\Person;
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
        $users = Person::all();

        return view("resume", compact("users", "header"));
    }
}
