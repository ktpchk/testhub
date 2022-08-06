<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTestRequest;
use App\Models\Test;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
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
        $tagValue = $request->tag;
        return view('tests.index', [
            'tests' => Test::latest()->filter($searchValue, $tagValue)->paginate(10),
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
        try {
            $test = DB::transaction(function () use ($inputData) {
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

                    $answersData = $questionVal['answers'];

                    if (array_key_exists('correct', $questionVal)) {
                        $correctAnswers = $questionVal['correct'];
                        if (!is_array($correctAnswers)) $correctAnswers = [$correctAnswers];
                        foreach ($answersData as $answerKey => $answerVal) {
                            $answersData[$answerKey]['correct'] = in_array($answerKey, $correctAnswers);
                        }
                    }

                    $question->answers()->createMany($answersData);
                }
                return $test;
            }, 5);

            return response()->json($test);
        } catch (Exception $e) {
            throw new HttpResponseException(
                response('При сохранении данных на сервер возникла ошибка. Попробуйте снова через какое-то время', 502)
            );
        }
    }

    public function publish(Test $test)
    {
        return view('tests.publish', [
            'test' => $test
        ]);
    }

    public function show(Test $test)
    {
        return view('tests.show', [
            'test' => $test
        ]);
    }

    public function question(Test $test)
    {
        return view('tests.question', [
            'test' => $test
        ]);
    }

    public function review(Request $request)
    {
        dd($request->all());
    }
}
