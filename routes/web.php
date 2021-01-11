<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/kamera', function () {
    return view('testkamera');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/cari', [App\Http\Controllers\DepartementController::class, 'searchDepartement'])->name('autocomplete');
  
// autocomplete  searchDepartement
// 
Route::group(['middleware' => ['role:admin|user']], function () {
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'profile'])->name('profile');
    Route::get('/getDepartementByDivisi/{id}', [App\Http\Controllers\DepartementController::class, 'getDepartementByDivisi'])->name('getDepartementByDivisi');
    
});

Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/user', [App\Http\Controllers\UserController::class, 'user'])->name('user');
    Route::post('/addUser', [App\Http\Controllers\UserController::class, 'addUser'])->name('addUser');
    Route::get('/getUserById/{id}', [App\Http\Controllers\UserController::class, 'getUserById'])->name('getUserById');
    
    
    
    
    Route::get('/allUser', [App\Http\Controllers\UserController::class, 'allUser'])->name('allUser');
    Route::get('/divisi', [App\Http\Controllers\DivisiController::class, 'divisi'])->name('divisi');
    Route::get('/allDivisi', [App\Http\Controllers\DivisiController::class, 'allDivisi'])->name('allDivisi');
    Route::get('/getAllDivisi', [App\Http\Controllers\DivisiController::class, 'getAllDivisi'])->name('getAllDivisi');
    
    Route::post('/addDivisi', [App\Http\Controllers\DivisiController::class, 'addDivisi'])->name('addDivisi');
    Route::get('/getDivisiById/{id}', [App\Http\Controllers\DivisiController::class, 'getDivisiById'])->name('getDivisiById');
    Route::get('/delDivisi/{id}', [App\Http\Controllers\DivisiController::class, 'delDivisi'])->name('delDivisi');
    
    Route::get('/departement', [App\Http\Controllers\DepartementController::class, 'departement'])->name('departement');
    Route::get('/allDepartement', [App\Http\Controllers\DepartementController::class, 'allDepartement'])->name('allDepartement');
    Route::get('/getDepartementById/{id}', [App\Http\Controllers\DepartementController::class, 'getDepartementById'])->name('getDepartementById');
    Route::post('/addDepartement', [App\Http\Controllers\DepartementController::class, 'addDepartement'])->name('addDepartement');
    Route::get('/delDepartement/{id}', [App\Http\Controllers\DepartementController::class, 'delDepartement'])->name('delDepartement');
 

    Route::get('/usulan', [App\Http\Controllers\UsulanController::class, 'usulan'])->name('usulan');
    Route::get('/allUsulan', [App\Http\Controllers\UsulanController::class, 'allUsulan'])->name('allUsulan');
    Route::get('/getUsulanById/{id}', [App\Http\Controllers\UsulanController::class, 'getUsulanById'])->name('getUsulanById');
    Route::post('/addUsulan', [App\Http\Controllers\UsulanController::class, 'addUsulan'])->name('addUsulan');
    Route::get('/delUsulan/{id}', [App\Http\Controllers\UsulanController::class, 'delUsulan'])->name('delUsulan');
 
    Route::get('/script', [App\Http\Controllers\ScriptController::class, 'script'])->name('script');
    Route::get('/scriptView/{param}', [App\Http\Controllers\ScriptController::class, 'scriptView'])->name('scriptView');
    Route::get('/scriptController/{param}', [App\Http\Controllers\ScriptController::class, 'scriptController'])->name('scriptController');
    Route::get('/scriptRoute/{param}', [App\Http\Controllers\ScriptController::class, 'scriptRoute'])->name('scriptRoute');

    
    //TEST SCRIP GENERATOR
    Route::get('/testscrip', [App\Http\Controllers\TestScripController::class, 'TestScrip'])->name('testscript');
    Route::get('/allTestScrip', [App\Http\Controllers\TestScripController::class, 'allTestScrip'])->name('allTestScrip');
    Route::post('/addTestScrip', [App\Http\Controllers\TestScripController::class, 'addTestScrip'])->name('addTestScrip');
    Route::get('/getTestScripById/{id}', [App\Http\Controllers\TestScripController::class, 'getTestScripById'])->name('getTestScripById');
    Route::get('/delTestScrip/{id}', [App\Http\Controllers\TestScripController::class, 'delTestScrip'])->name('delTestScrip');
 
    
            
    //TEST SCRIP GENERATOR Project
    Route::get('/project', [App\Http\Controllers\ProjectController::class, 'Project'])->name('project');
    Route::get('/allProject', [App\Http\Controllers\ProjectController::class, 'allProject'])->name('allProject');
    Route::post('/addProject', [App\Http\Controllers\ProjectController::class, 'addProject'])->name('addProject');
    Route::get('/getProjectById/{id}', [App\Http\Controllers\ProjectController::class, 'getProjectById'])->name('getProjectById');
    Route::get('/delProject/{id}', [App\Http\Controllers\ProjectController::class, 'delProject'])->name('delProject');
       
    
            
    //TEST SCRIP GENERATOR
    Route::get('/projectactivity', [App\Http\Controllers\ProjectActivityController::class, 'ProjectActivity'])->name('projectactivity');
    Route::get('/allProjectActivity', [App\Http\Controllers\ProjectActivityController::class, 'allProjectActivity'])->name('allProjectActivity');
    Route::post('/addProjectActivity', [App\Http\Controllers\ProjectActivityController::class, 'addProjectActivity'])->name('addProjectActivity');
    Route::get('/getProjectActivityById/{id}', [App\Http\Controllers\ProjectActivityController::class, 'getProjectActivityById'])->name('getProjectActivityById');
    Route::get('/delProjectActivity/{id}', [App\Http\Controllers\ProjectActivityController::class, 'delProjectActivity'])->name('delProjectActivity');
        
});

