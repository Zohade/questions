<?php

use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;


//Route::get('/',[QuestionController::class,'index'])->name('question');
Route::get('/', [QuestionController::class,'index'])->name('index');
Route::post('/quiz-soumission', [QuestionController::class, 'checkAnswers'])->name('soumission');
//Route::get('/quiz-answers', [QuestionController::class, 'next'])->name('quiz-answers');
// Route::get('/score', [QuestionController::class, 'showScore'])->name('score');
