<?php

namespace App\Http\Controllers;

use App\Models\question;
use App\Models\option;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::with([
            'options' => function ($query) {
                $query->inRandomOrder();
            }
        ])->inRandomOrder()->take(10)->get();
        session(['questions' => $questions]);
        return view('question', compact(['questions']));

    }
    public function checkAnswers(Request $request)
    {
        $userInputAnswers = $request->input('answers', []);
        $questions = session()->get('questions');

        $totalCorrect = 0;

        foreach ($questions as $key => &$question) {
            $question['user_answers'] = $userInputAnswers[$question['id']] ?? [];

            if (!is_array($question['user_answers'])) {
                $question['user_answers'] = [$question['user_answers']];
            }
            $correctOptionIds = collect($question['options'])
            ->filter(fn($opt) => $opt->is_true)
            ->pluck('id')
            ->map(fn($id) => (int) $id)
            ->sort()
            ->values();

            $userOptionIds = collect($question['user_answers'])
                ->map(fn($id) => (int) $id)
                ->sort()
                ->values();

            $isCorrect = $correctOptionIds->toArray() === $userOptionIds->toArray();

            if ($isCorrect) {
                $totalCorrect++;
            }

            foreach ($question['options'] as &$option) {
                $option['is_user_selected'] = in_array($option['id'], $question['user_answers']);
            }
        }

        $score = round(($totalCorrect / 10) * 100);

        return view('score', compact('questions', 'score'));
    }


    public function next(){
        session([
            'feedback' => '' ,
            'is_correct' => '',
            'correct_answers' => [],
            'last_user_answers' => [],
        ]);

        $questionId = session()->get('current_question');
        if($questionId+1<=session()->get('nbre_question')){
            $question = Question::where(['id' => $questionId + 1])->first();
            session(['current_question' => $question->id]);
            $options = Option::where(['question_id'=>$question->id])->get();
            return view('question', compact(['question', 'options']));
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $question = Question::with('options')->findOrFail($id);
        session(['current_question' => $question->id]);

        return view('question', [
            'question' => $question,
            'options' => $question->options
        ]);
    }
    public function showScore(){
       $score = session()->get('score');
       return view('score',compact('score'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(question $question)
    {
        //
    }
}