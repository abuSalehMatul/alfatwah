<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'HomeController@redirectToHome');

//
Route::group([
    'prefix' => '{locale}',
    'where' => ['locale' => '[a-zA-Z]{2}'],
    'middleware' => 'setlocale'
], function () {
    //
    Auth::routes();

  
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/category/{id}', 'CategoryController@showByCategory')->name('get_category_based');
    Route::get('get-question-answer/{questionId}', 'QuestionsController@getAnswerByQuestion')->name('question.answer')->middleware('count_view');
    Route::get('answer/{batchId}', 'AnswerController@findAnswer')->name('to_a_answer');
    Route::get('new-ans-list', 'AnswerController@getList')->name('new_answer_list');

    Route::get('selected-question', 'QuestionsController@selectedQuestions')->name('selected.answer');
    Route::get('article/{id}', 'ArticleController@show')->name('article');
    Route::get('articles', 'ArticleController@getAll')->name('all_article');
    Route::get('all-media', 'HomeController@getAllMediaView');
    Route::get('about-us', 'HomeController@aboutUs')->name('about.us');
    Route::get('go-to-answer/{id}', 'QuestionsController@toAAnswer')->name('go.to.ans');
    Route::get("on-development", "HomeController@onDevelp")->name("ondevelop");
    Route::get("get-slider-img/{lang}", "SettingController@getSliderImg")->name('slider.image.get');

    Route::group(['middleware' => 'auth'], function () {
        Route::get('profile/{id}', 'HomeController@getProfile')->name('profile');
        Route::resource('questions', 'QuestionsController');
    });

});


Route::group(['prefix' => 'api'], function () {
    Route::get('get-category', 'CategoryController@getAll');
    Route::get("question-by-cat-id/{id}", "CategoryController@getQuestionCount");
    Route::get('new-answers', 'AnswerController@newAnswers');
    Route::get('selected-question', 'QuestionsController@getSelectedQuestion');
    Route::get('get-category-based-question/{catId}', 'CategoryController@getQuestionByCategory');
    Route::get('get-most-read', 'QuestionsController@getMostRead');
    Route::get('get-articles', 'ArticleController@getShortList');
    Route::get('get-books', 'BookController@getBooks');
    Route::get('get-search', 'QuestionsController@search');
    Route::get('get-media-show/{lang}', 'HomeController@getMediaActives');
   
});

Route::prefix('admin')->namespace('Admin')->group(function () {
    Route::middleware(['auth', 'role:admin|sub_admin'])->group(function () {
        Route::get('/', 'AdminController@index')->name('admin');
        Route::get('questions', 'QuestionController@getAll')->name("admin.questions");
        Route::get('question/{id}', 'QuestionController@find')->name('admin.question');
        Route::post('add-tag', 'QuestionController@addTagCategory')->name("question.add.tag_category");
        Route::get('answered-questions', 'QuestionController@answeredQuestions')->name('admin.answered.questions');
        Route::get('all-questions', 'QuestionController@allQuestions')->name('admin.all.questions');
        Route::get('answer-question/{id}', 'QuestionController@answer')->name('admin.question.answer');
        Route::get('question-edit/{id}', 'QuestionController@edit')->name('question.edit');
        Route::post('question-edit', 'QuestionController@saveEdit')->name('admin.question.edit');
        Route::get('articles', 'ArticleController@getAll')->name('admin.articles');
        Route::get('article/{id}', 'ArticleController@find')->name('admin.article.find');
        Route::post('article-edit', 'ArticleController@edit')->name('admin.article.edit');
        Route::get('books', 'BookController@getAll')->name('admin.books');
        Route::get('add-book', 'BookController@createForm');
        Route::post('add-book', 'BookController@save')->name('admin.book.create.save');
        Route::get('category', 'CategoryController@getAll')->name('admin.category');
        Route::get('get-media', 'MediaController@getMedia')->name('admin.media');
        Route::get('add-media', 'MediaController@add')->name('admin.add.media');
        Route::post('store-media', 'MediaController@store')->name('admin.media.store');
        Route::get('email', 'AdminController@email')->name('admin.email');
        Route::post('send-email', 'AdminController@sendEmail')->name('admin.send.email');
    });
    Route::middleware(['auth', 'role:admin'])->group(function(){
        Route::get('change-question0-status/{id}/{status}', 'QuestionController@changeStatus')->name('question.change.status');
        Route::get('change-selection/{id}', 'QuestionController@changeSelection')->name('question.selection');
        Route::get('article-create', 'ArticleController@createForm')->name('admin.create.article');
        Route::post('article-create', 'ArticleController@save')->name('admin.article.create.save');
        Route::get('admin-category', 'CategoryController@add')->name('admin.add.category');
        Route::post('admin-category', 'CategoryController@save')->name('admin.category.save');
    });
});

Route::prefix('admin/api')->namespace('Admin')->group(function(){
    Route::middleware(['auth', 'role:admin|sub_admin'])->group(function(){
        Route::get('get-question/{lang}/{id}', 'QuestionController@findApi');
        Route::post('save-answer', 'AnswerController@save');
        Route::get('question-doughnut-by-answered', 'ReportController@getQuestionDoughnutByAnswered');
        Route::get('question-doughnut-by-status', 'ReportController@getQuestionDoughnutByStatus');
        Route::get('get-by-answer-stat', 'ReportController@getAnswerStat');
        Route::get('search', 'ReportController@getSearch');
       
    });
    
    Route::middleware(['auth', 'role:admin'])->group(function(){
        Route::get('change-answer-status/{status}/{id}', 'AnswerController@changeStatus');
        Route::get('article-status-change/{id}/{status}', 'ArticleController@changeStatus');
        Route::get('change-book-status/{id}/{status}', 'BookController@changeStatus');
        Route::get('delete-category/{id}', 'CategoryController@delete');
        Route::get('delete-media/{id}', 'MediaController@del');
        Route::get('status-change-media/{id}/{status}', 'MediaController@changeStatus');
    });
});

Route::prefix('root')->middleware(['role:root'])->namespace('Admin')->group(function(){
    Route::get('/', 'AdminController@root')->name('root.admin');
    Route::post('admin-edit', 'AdminController@edit')->name('admin.edit');
    Route::post('admin-save', 'AdminController@save')->name('admin.save');
    Route::get('admin-delete/{id}', 'AdminController@delete')->name('admin.delete');
    Route::get('email-root', 'AdminController@getEmailList')->name('root.email');
});