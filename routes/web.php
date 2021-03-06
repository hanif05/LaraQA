<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'QuestionsController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('questions', 'QuestionsController')->except('show');
Route::resource('questions.answers', 'AnswersController')->except('index', 'create', 'show');
Route::post('answers/{answer}/accept', 'AcceptAnswerController')->name('answers.accept');
Route::get('questions/{slug}', 'QuestionsController@show')->name('questions.show');

Route::post('questions/{question}/favorites', 'FavoritesController@store')->name('question.favorite');
Route::delete('questions/{question}/favorites', 'FavoritesController@destroy')->name('question.unfavorite');

Route::post('question/{question}/vote', 'VoteQuestionController')->name('questions.votes');
Route::post('answer/{answer}/vote', 'VoteAnswerController')->name('answers.votes');