<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function welcome()
    {
        return view('tests.welcome', [
            'tests' => Test::latest()->limit(5)->get()
        ]);
    }

    public function index(Request $request)
    {
        $searchValue = $request->search;
        return view('tests.index', [
            'tests' => Test::latest()->filter($searchValue)->paginate(10),
            'searchValue' => $searchValue
        ]);
    }

    public function create()
    {
        return view('tests.create');
    }

    public function store(Request $request)
    {
        dd($request->all());
    }
}
