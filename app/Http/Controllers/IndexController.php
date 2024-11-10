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

        return view("page", compact("users", "header"));
    }

    public function stageFromTo(): View
    {
        $header = 'Резюме и вакансии';
        $users = Person::select(['FIO'])
            ->where('Stage', '>=', 5)
            ->where('Stage', '<=', 15)
            ->get();

        return view("page", compact("users", "header"));
    }

    public function itGuy(): View
    {
        $header = 'Резюме и вакансии';
        $users = Person::select(['FIO', 'Stage'])
            ->join('Staff', 'Person.Staff', '=', 'Staff.id')
            ->where('Staff.staff', 'Программист')
            ->get();

        return view("page", compact("users", "header"));
    }

    public function resumeCount(): View
    {
        $header = 'Резюме и вакансии';
        $resumeCount = Person::count();
        $datas = [];
        $datas['Кол-во резюме'] = $resumeCount;

        return view("page", compact("datas", "header"));
    }

    public function activeStaff(): View
    {
        $header = 'Резюме и вакансии';
        $activeStaff = Person::select(['Staff.staff'])
        ->join('Staff', 'Person.Staff', '=', 'Staff.id')
        ->groupBy('Person.Staff')
        ->get();

        $datas = [];
        $count = 0;
        foreach ($activeStaff as $staff) {
            $count++;
            $datas["Активная профессия #$count"] = $staff->staff;
        }

        return view("page", compact("datas", "header"));
    }
}
