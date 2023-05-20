<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MarkController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ReitCompanyController;
use App\Http\Controllers\Admin\ReitController;
use App\Http\Controllers\Admin\StudentController;
use  Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//   return view('welcome');
// });

Auth::routes();

/* ------------------------------------------
  --------------------------------------------
  All Normal Users Routes List
  --------------------------------------------
  -------------------------------------------- */
//Route::middleware(['auth', 'user-access:user'])->group(function () {

Route::get('/', [HomeController::class, 'index'])->name('front.home');
Route::get('/results', [HomeController::class, 'results'])->name('front.results');
Route::get('/contact', [HomeController::class, 'contact'])->name('front.contact');
Route::post('/generate-pdf', [HomeController::class, 'generatePDF'])->name('front.myPDF');;
Route::get('/{slug}', [HomeController::class, 'pages'])->name('front.pages');

//});

/* ------------------------------------------
  --------------------------------------------
  All Admin Routes List
  --------------------------------------------
  -------------------------------------------- */
Route::middleware(['auth', 'user-access:admin'])->group(function () {
  Route::get('/admin', [MainController::class, 'dashboard'])->name('admin.home');
  Route::get('/autocomplete', [MainController::class, 'autocomplete'])->name('autocomplete');
  Route::get('/population', [MainController::class, 'population'])->name('population');
  Route::post('/population-radius', [MainController::class, 'population_radius'])->name('population-radius');
  Route::post('/search-zip', [MainController::class, 'search_zip'])->name('search-zip');


  Route::get('/admin/reits/createsingle', [ReitController::class, 'createsingle'])->name('reits.createsingle');
  Route::match(['get', 'post'], '/admin/reits/storesingle', [ReitController::class, 'storesingle'])->name('reits.storesingle');

  Route::resource('/admin/reits', ReitController::class);
  Route::resource('/admin/pages', PageController::class);

  Route::get('/admin/students/createsingle', [StudentController::class, 'createsingle'])->name('students.createsingle');
  Route::match(['get', 'post'], '/admin/marks/storesingle', [StudentController::class, 'storesingle'])->name('students.storesingle');
  Route::resource('/admin/students', StudentController::class);



  Route::get('/admin/marks/createsingle', [MarkController::class, 'createsingle'])->name('marks.createsingle');
  Route::match(['get', 'post'], '/admin/marks/storesingle', [MarkController::class, 'storesingle'])->name('marks.storesingle');

  Route::resource('/admin/marks', MarkController::class);
});

Auth::routes();

Route::get('/admin', [MainController::class, 'dashboard'])->name('admin.home');
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/phpinfo', function () {
  phpinfo();
});
