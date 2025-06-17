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
        $data = json_decode(file_get_contents(database_path('data/aws_questions.json')), true);

        foreach ($data as $item) {
            $question = Question::create([
                'libele' => $item['title'],
                'reponse_unique' => ($item['type']) === "radio",
            ]);

            foreach ($item['options'] as $index => $option) {
                Option::create([
                    'libele' => $option['title'],
                    'is_true' => $option['status']==="right",
                    "explanation"=>$option['explanation'],
                    'question_id' => $question->id,
                ]);
            }
        }
    }
}