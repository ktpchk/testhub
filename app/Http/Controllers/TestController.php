<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTestRequest;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function store(StoreTestRequest $request)
    {
        $inputData = $request->validated();
        DB::transaction(function () use ($inputData) {
            $testData = [
                'name' => $inputData['name'],
                'tags' => $inputData['tags'],
                'description' => $inputData['description'] ?? null,
                'time' => $inputData['time'] ?? 0,
            ];

            $testOptionData =
                [
                    'detailed_results' => ($inputData['options'] ?? false) && in_array('detailedResults', $inputData['options']),
                    'public_results' => ($inputData['options'] ?? false) && in_array('publicResults', $inputData['options']),
                ];

            $test = Test::create($testData);
            $test->option()->create($testOptionData);

            foreach ($inputData['questions'] as $questionKey => $questionVal) {
                $question = $test->questions()->create($questionVal);

                $answers = $questionVal['answers'];
                $correctAnswers = $questionVal['correct'];
                if (!is_array($correctAnswers)) $correctAnswers = [$correctAnswers];
                foreach ($answers as $answerKey => $answerVal) {
                    $answers[$answerKey]['correct'] = in_array($answerKey, $correctAnswers);
                }
                $question->answers()->createMany($answers);
            }
        }, 5);

        return response()->json([], 200);
        // return response()->json()
    }
}
