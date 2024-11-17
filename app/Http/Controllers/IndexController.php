<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Staff;
use Illuminate\Contracts\View\View;

class IndexController extends Controller
{
    protected array $menuButtons = [
        'Активные резюме' => 'show',
        'Фамилии персон, имеющих стаж от 5 до 15 лет' => 'stage-5-to-15',
        'Фамилии и стаж людей с профессией Программист' => 'it-guy',
        'Общее число резюме в базе' => 'resume-count',
        'Профессии, представители которых имеются в резюме' => 'active-staff',
        'Добавить резюме' => 'add-resume'
    ];

    public function index(): View
    {
        $menuButtons = $this->menuButtons;
        $header = 'Резюме и вакансии';
        return view('page', compact('header', 'menuButtons'));
    }

    public function show(): View
    {
        $header = 'Активные резюме';
        $menuButtons = $this->menuButtons;
        $resumes = Person::all();

        return view(
            'resumes',
            compact(
                'resumes',
                'header',
                'menuButtons'
            )
        );
    }

    public function stageFromTo(): View
    {
        $header = 'Фамилии персон, имеющих стаж от 5 до 15 лет';
        $menuButtons = $this->menuButtons;
        $users = Person::select(['FIO'])
            ->where('Stage', '>=', 5)
            ->where('Stage', '<=', 15)
            ->get();
        $data = [
            'titles' => ['Фамилия'],
            'values' => []
        ];
        foreach ($users as $user) {
            $data['values'][] = $user->FIO;
        }
        return view(
            'table',
            compact(
                'data',
                'header',
                'menuButtons'
            )
        );
    }

    public function itGuy(): View
    {
        $header = 'Фамилии и стаж людей с профессией Программист';
        $menuButtons = $this->menuButtons;
        $users = Person::select(['FIO', 'Stage'])
            ->join('Staff', 'Person.Staff', '=', 'Staff.id')
            ->where('Staff.staff', 'Программист')
            ->get();

        $data = [
            'titles' => ['Фамилия', 'Стаж'],
            'values' => []
        ];
        foreach ($users as $user) {
            $data['values'][] = [$user->FIO, $user->Stage];
        }

        return view(
            'table',
            compact(
                'data',
                'header',
                'menuButtons'
            )
        );
    }

    public function resumeCount(): View
    {
        $header = 'Общее число резюме в базе';
        $menuButtons = $this->menuButtons;
        $resumeCount = Person::count();
        $data = [
            'titles' => ['Кол-во резюме'],
            'values' => [$resumeCount]
        ];

        return view(
            'table',
            compact(
                'data',
                'header',
                'menuButtons'
            )
        );
    }

    public function activeStaff(): View
    {
        $header = 'Профессии, представители которых имеются в резюме';
        $menuButtons = $this->menuButtons;
        $activeStaff = Person::select(['Staff.staff'])
            ->join('Staff', 'Person.Staff', '=', 'Staff.id')
            ->groupBy('Person.Staff')
            ->get();

        $data = [
            'titles' => ['Профессия'],
            'values' => []
        ];
        foreach ($activeStaff as $staff) {
            $data['values'][] = $staff->staff;
        }

        return view(
            'table',
            compact(
                'data',
                'header',
                'menuButtons'
            )
        );
    }

    public function addResume(): View
    {
        $fields = [
            [
                'key' => 'fio',
                'type' => 'string',
                'validation' => [
                    'required' => true,
                    'regexp' => '/[\-А-Яа-я a-zA-Z]*/',
                    'message' => 'не может быть пустым и должен состоять из буквенных символов',
                ],
            ],
            [
                'key' => 'stuff',
                'type' => 'string',
                'validation' => [
                    'required' => true,
                    'regexp' => '/[0-9]{1}/',
                    'message' => 'не может быть пустым и должен состоять из цифр',
                ],
            ],
            [
                'key' => 'phone',
                'type' => 'string',
                'validation' => [
                    'required' => true,
                    'regexp' => '/+7 ([0-9]{3}) [0-9]{3}-[0-9]{2}-[0-9]{2}/',
                    'message' => 'не может быть пустым и должен быть формата телефона',
                ],
            ],
            [
                'key' => 'stage',
                'type' => 'string',
                'validation' => [
                    'required' => true,
                    'regexp' => '/[1-9]{3}/',
                    'message' => 'не может быть пустым и должен состоять из цифр',
                ],
            ],
            [
                'key' => 'image',
                'type' => 'file',
                'typesOfFiles' => ['image/jpeg', 'image/png', 'image/gif'],
                'size' => 500000,
                'validation' => [
                    'required' => true,
                    'message' => 'не может быть пустым',
                ],
            ],
        ];


        $data = [];
        $error = [];
        if (!empty($_POST)) {
            foreach ($fields as $field) {
                switch ($field['type']) {
                    case 'file':
                        if (key_exists($field['key'], $_FILES)) {
                            $file = request()->{$field['key']};

                            if (!in_array($file->getMimeType(), $field['typesOfFiles'])) {
                                $error[$field['key']] = ['недопустимый тип изображения'];
                            }

                            if ($file->getSize() > $field['size']) {
                                $error[$field['key']][] = ['слишком большое изображение'];
                            }

                            $extension = explode('/', $_FILES[$field['key']]['type'])[1];
                            $filename = hash('sha256', $_FILES[$field['key']]['name']) . '.' . $extension;
                            $data[$field['key']] = $filename;

                            $target_path = public_path() . '/images/';
                            $file->move($target_path, $filename);
                        } else {
                            $data[$field['key']] = null;
                        }
                        break;
                    case 'string':
                        $data[$field['key']] = key_exists($field['key'], $_POST) ? trim($_POST[$field['key']], '_') : null;
                        if (
                            ($data[$field['key']] === null && $field['validation']['required'])
                            && (preg_match_all($field['validation']['regexp'], $data[$field['key']]) === false)
                        ) {
                            $error[$field['key']][] = [$field['validation']['message']];
                        }
                        break;
                }
            }
        }

        if (empty($error) && !empty($data)) {
            $person = new Person();
            $person->FIO = $data['fio'];
            $person->Staff = $data['stuff'];
            $person->Phone = $data['phone'];
            $person->Image = $data['image'];
            $person->Stage = $data['stage'];

            $person->save();
        }

        $header = 'Новое резюме';
        $menuButtons = $this->menuButtons;
        $stuff = Staff::all();
        return view(
            'newResume',
            compact(
                'stuff',
                'header',
                'menuButtons',
                'error',
                'data',
            )
        );
    }
}
