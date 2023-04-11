<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\InstituteController;
use App\Http\Controllers\Admin\AuthInstituteController;

//Home route
Route::get('/', function() {
    return view('auth.login');
});
// admin route
Route::get('/login',[AuthInstituteController::class, 'loginShow'])->name('login');
Route::post('/login',[AuthInstituteController::class, 'authCheck'])->name('login.check');

Route::group(['middleware' => ['auth:institute']] , function(){
    Route::get('logout', [AuthInstituteController::class, 'logout'])->name('logout');
    Route::get('dashboard', [AuthInstituteController::class, 'dashboard'])->name('dashboard');
    Route::prefix('setting')->group(function(){
            Route::get('/user-edit', [InstituteController::class, 'edit'])->name('user.edit');
            Route::put('/user-update', [InstituteController::class, 'updateUser'])->name('user.update');
            Route::get('/password/change', [InstituteController::class, 'passwordChange'])->name('password.change');
            Route::post('/password/update', [InstituteController::class, 'passwordUpdate'])->name('password.update');
    });

    Route::prefix('applicant')->group(function(){
        Route::get('/application-list', [ApplicantController::class, 'index'])->name('applicant.index');
        Route::post('/search-applicant', [ApplicantController::class, 'searchResult'])->name('search.applicant');
        Route::post('applicant-update',[ApplicantController::class,'updateRegistration'])->name('applicant.update');
        Route::get('/edit-application/{id}',[ApplicantController::class,'edit']);

    });

    Route::prefix('setup')->group(function(){
        //Exam CRUD Route
        Route::get('/exam-entry', [ExamController::class, 'index'])->name('exam.index');
        Route::post('/exam-store', [ExamController::class, 'store'])->name('exam.store');
        Route::put('/exam-update/{id}',[ExamController::class,'update'])->name('exam.update');
        Route::get('/edit-exam/{id}',[ExamController::class,'edit'])->name('exam.edit');
        Route::delete('/exam-delete/{id}',[ExamController::class,'destroy'])->name('exam.destroy');


    });

    //Contact us  route
    Route::get('/contact-us',[ContactUsController::class,'index'])->name('contact.us');
    Route::post('/contact-us/update',[ContactUsController::class,'update'])->name('contact-us.update');

});



