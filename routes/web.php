<?php

use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::get('/questions', [QuestionController::class,'index'])->name('index');
Route::post('/quiz-soumission', [QuestionController::class, 'checkAnswers'])->name('soumission');
