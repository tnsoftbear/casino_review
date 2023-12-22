<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Casino;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CasinoController extends Controller
{
    public function __construct(Request $request) {
        //session()->invalidate();
        //session()->regenerate();
        echo "key2: " . session()->get("key2");
        session()->put("key2", "value2");
        if ($request->hasSession()) {
            $request->session()->put("key1", "value1");
        } else {
            echo "no session in request";
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //dump(session()->all());
        $casinos = Casino::orderBy('id', 'desc')->get();
        $pageTitle = 'Casino List';
        return view('admin.casino.index', compact('casinos', 'pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Create Casino';
        $description = old('description');
        $name = old('name');
        $rubric_id = old('rubric_id');
        $site_url = old('site_url');
        return view('admin.casino.create', compact(
            'pageTitle', 'name', 'rubric_id', 'site_url', 'description'));
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate($this->getValidationRules($request));
        Casino::create($validatedData);
        return redirect()->route('casino.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return "Show casino by id: " . $id;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pageTitle = 'Edit Casino';
        $casino = Casino::find($id);
        $description = old('description') ?? $casino->description;
        $name = old('name') ?? $casino->name;
        $rubric_id = old('rubric_id') ?? $casino->rubric_id;
        $site_url = old('site_url') ?? $casino->site_url;
        return view('admin.casino.edit', compact(
            'pageTitle', 'id', 'rubric_id', 'name', 'site_url', 'description'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate($this->getValidationRules($request, (int)$id));
        $casino = Casino::find($id);
        $casino->update($validatedData);
        return redirect()->route('casino.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $casino = Casino::find($id);
        $casino->delete();
        return redirect()->route('casino.index');
    }

    private function getValidationRules(Request $request, int $id = null) {
        $uniqueNameRule = $id ? Rule::unique('casino')->ignore($id) : 'unique:casino';
        $validationRules = [
            'name' => [
                'required',
                'max:255',
                $uniqueNameRule
            ],
            'rubric_id' => Rule::in(array_keys(config('casino.rubric'))),
            'site_url' => [
                // 'sometimes', // Правило будет применяться только если поле присутствует во входных данных
                // 'nullable',  // Разрешаем поле быть null
                Rule::requiredIf(function () use ($request) {
                    // Применяем правило только если поле не пустое
                    return !empty($request->input('site_url'));
                }),
                'url',
            ],
            'description' => '',
        ];
        return $validationRules;
    }
}
