<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\question;
use App\Models\option;

class QuestionsTablesSeeders extends Seeder
{
    public function run()
    {
        $data = json_decode(file_get_contents(database_path('data/questions.json')), true);

        foreach ($data as $item) {
            $question = Question::create([
                'libele' => $item['q'],
                'reponse_unique' => count($item['answers']) === 1,
            ]);

            foreach ($item['options'] as $index => $optionText) {
                Option::create([
                    'libele' => $optionText,
                    'is_true' => in_array($index, $item['answers']),
                    'question_id' => $question->id,
                ]);
            }
        }
    }
}
