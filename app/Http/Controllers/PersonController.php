<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonCreateRequest;
use App\Http\Requests\PersonUpdateRequest;
use App\Models\Person;
use App\Models\Staff;
use Illuminate\Http\Request;
use \Illuminate\Contracts\View\View;

class PersonController extends Controller
{
    protected array $menuButtons = [
        [
            'title' => 'Активные резюме',
            'link' => 'persons',
        ],
        [
            'title' => 'Добавить резюме',
            'link' => 'persons/create',
        ],
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $header = 'Активные резюме';
        $menuButtons = $this->menuButtons;
        $showDetail = true;

        $resumes = Person::all();


        return view(
            'person.index',
            compact(
                'header',
                'menuButtons',
                'resumes',
                'showDetail'
            ),
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $header = 'Активные резюме';
        $menuButtons = $this->menuButtons;
        $stuff = Staff::all();


        return view(
            'person.create',
            compact(
                'header',
                'menuButtons',
                'stuff'
            ),
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PersonCreateRequest $request): \Illuminate\Http\RedirectResponse
    {
        $validatedData = $request->validate($request->rules());

        foreach ($validatedData as $key => $value) {
            $validatedData[$key] = trim($value, '_');
        }

        $extension = explode('/', $request->Image->getMimeType())[1];
        $filename = hash('sha256', $request->Image) . '.' . $extension;
        $validatedData['Image'] = $filename;

        $target_path = public_path() . '/images/';
        $request->Image->move($target_path, $filename);
        Person::create($validatedData);

        return redirect()->route('persons.index')
            ->with('success', 'Person created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $header = 'Резюме #' . $id;
        $showDetail = false;

        $user = Person::find($id);
        $menuButtons = $this->menuButtons;

        return view(
            'person.show',
            compact(
                'header',
                'menuButtons',
                'showDetail',
                'user',
            ),
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $person)
    {
        $header = 'Резюме #' . $person;

        $user = Person::find($person);
        $menuButtons = $this->menuButtons;

        $stuff = Staff::all();


        return view(
            'person.edit',
            compact(
                'header',
                'menuButtons',
                'user',
                'stuff'
            ),
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PersonUpdateRequest $request, string $id)
    {
        $validatedData = $request->validate($request->rules());

        if ($request->Image != null) {
            $extension = explode('/', $request->Image->getMimeType())[1];
            $filename = hash('sha256', $request->Image) . '.' . $extension;
            $validatedData['Image'] = $filename;

            $target_path = public_path() . '/images/';
            $request->Image->move($target_path, $filename);
        }
        Person::find($id)->fill($validatedData)->save();

        return redirect()->route('persons.index')
            ->with('success', 'Person updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Person::destroy($id);
        return json_encode(['result' => true]);
    }
}
