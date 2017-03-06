<?php
/******************************************************************
 * Rotas do Painel
 ******************************************************************/
Route::group(['prefix' => 'painel', 'middleware' => 'auth'], function(){
    
    
    
    //Routes Users
    Route::any('usuarios/pesquisar', 'Painel\UserController@search')->name('usuarios.search');
    Route::resource('usuarios', 'Painel\UserController');
    //Routes Categories
   
    Route::resource('contador', 'Painel\ContadorRegistroController');
    
    
    //Routes Categories
    Route::any('categorias/pesquisar', 'Painel\CategoryController@search')->name('categorias.search');
    Route::resource('categorias', 'Painel\CategoryController');
    
    //Routes Posts
    Route::any('posts/pesquisar', 'Painel\PostController@search')->name('posts.search');
    Route::resource('posts', 'Painel\PostController'); 
 
   
    
    Route::get('posts-gerar-url/{id}', 'Painel\PostContadorCodigoController@store');
    //Routes Ganhos
    Route::get('ganhos', 'Painel\PainelController@ganhos');    
    
    //Route Profile User
    Route::get('perfil', 'Painel\UserController@showProfile')->name('profile');
    Route::post('perfil/{id}', 'Painel\UserController@updateProfile')->name('profile.update');
    
    //Routes Comments
    Route::any('comentarios/pesquisar', 'Painel\CommentController@search')->name('comments.search');
    Route::get('comentarios', 'Painel\CommentController@index')->name('comments');
    Route::get('comentario/{id}/respostas', 'Painel\CommentController@answers');
    Route::post('comentario/{id}/answer', 'Painel\CommentController@answerComment')->name('answer-comment');
    Route::post('comentario/{id}/destroy', 'Painel\CommentController@destroy')->name('destroy-comment');
    Route::get('comentario/{id}/resposta/{idAnswer}/delete', 'Painel\CommentController@destroyAnswer')->name('destroy-answer');


    Route::get('/', 'Painel\PainelController@index'); 
});
/******************************************************************
 * End Routes Painel
 ******************************************************************/


/******************************************************************
 * Rotas de Autenticação
 ******************************************************************/
// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
/******************************************************************
 * Rotas de Registrar-se
 ******************************************************************/
Route::get('register', 'Auth\RegisterController@showRegistrationForm');
Route::post('register', 'Auth\RegisterController@register');

/******************************************************************
 * Rotas do Site
 ******************************************************************/
Route::any('/buscar', 'Site\SiteController@search')->name('search.blog');
Route::post('/comment-post', 'Site\SiteController@commentPost')->name('comment');
Route::get('/tutorial/{url}/{id}', 'Site\SiteController@post')->name('post');
Route::get('/tutorial/{url}', 'Site\SiteController@postUrl')->name('post');
Route::get('/categoria/{url}', 'Site\SiteController@category');
Route::get('empresa', 'Site\SiteController@company');
Route::get('como-funciona', 'Site\SiteController@instrucao');
Route::get('contato', 'Site\SiteController@contact');
Route::post('contact', 'Site\SiteController@sendContact')->name('contact');
Route::get('/', 'Site\SiteController@index');
/******************************************************************
 * End Routes Site
 ******************************************************************/