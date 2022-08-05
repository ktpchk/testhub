<?php

namespace Database\Seeders;

use App\Models\QuestionAnswer;
use App\Models\Test;
use App\Models\TestOption;
use App\Models\TestQuestion;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

        $test = Test::factory()->create();

        TestOption::factory()->create([
            'test_id' => $test->id
        ]);

        $testQuestion = TestQuestion::factory()->create([
            'test_id' => $test->id,
            'number' => 1
        ]);

        QuestionAnswer::factory()->create([
            'test_question_id' => $testQuestion->id
        ]);

        // Test::factory(245)->create();
    }
}
