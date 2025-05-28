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
        //initialistion des sessions
        session([
            'feedback' => '' ,
            'is_correct' => '',
            'correct_answers' => [],
            'last_user_answers' => [],
        ]);
        //compte du nombre total de questions
        $total = Question::count();
        session(['nbre_question' => $total]);
        //récuperation de la première question
        $question = Question::first();
        session(['current_question' => $question->id]);
        //récuperation des options
        $options = Option::where(['question_id' => $question->id])->get();

        //initialisation du score du joueur
        session(['score' => 0]);
        return view('question', compact(['question', 'options']));

    }
    public function checkAnswers(Request $request)
    {
        $selected = $request->input('answer');
        $selected = is_array($selected) ? $selected : [$selected];

        $questionId = session()->get('current_question');
        $question = Question::with('options')->findOrFail($questionId);

        $correctOptionIds = $question->options->where('is_true', true)->pluck('id')->toArray();

        $isCorrect = count(array_diff($selected, $correctOptionIds)) === 0 &&
                     count(array_diff($correctOptionIds, $selected)) === 0;

        if ($isCorrect) {
            session(['score' => session('score', 0) + 1]);
        }

        session([
            'feedback' => $isCorrect ? 'Correct!' : 'Wrong!',
            'is_correct' => $isCorrect,
            'correct_answers' => $correctOptionIds,
            'last_user_answers' => $selected,
        ]);

        if($questionId==session()->get('nbre_question')){
            return to_route('score');
        }
        return redirect()->route('show-question', ['id' => $questionId]);
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
