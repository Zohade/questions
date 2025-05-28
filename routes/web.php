<?php

use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;


Route::get('/',[QuestionController::class,'index'])->name('question');
Route::post('/quiz-soumission', [QuestionController::class, 'checkAnswers'])->name('soumission');
Route::get('next-quiz', [QuestionController::class, 'next'])->name('next-quiz');
Route::get('/quiz/{id}', [QuestionController::class, 'show'])->name('show-question');
Route::get('/score', [QuestionController::class, 'showScore'])->name('score');
