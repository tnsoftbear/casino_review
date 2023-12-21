<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Casino;
use Illuminate\Http\Request;

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
        dump($request->route()->getName());
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
        return view('admin.casino.create', ['pageTitle' => 'Create Casino']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $casino = new Casino;
        $casino->name = $request->name;
        $casino->site_url = $request->site_url;
        $casino->description = $request->description;
        $casino->save();
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
        return view('admin.casino.edit', compact('casino', 'pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $casino = Casino::find($id);
        $casino->name = $request->name;
        $casino->site_url = $request->site_url;
        $casino->description = $request->description;
        $casino->save();
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
}
