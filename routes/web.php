<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ExampleController;
use App\Http\Controllers\ProdiController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('prodi', ProdiController::class);

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/change-password', [ProfileController::class, 'changepassword'])->name('profile.change-password');
    Route::put('/profile/password', [ProfileController::class, 'password'])->name('profile.password');
    Route::get('/blank-page', [App\Http\Controllers\HomeController::class, 'blank'])->name('blank');

    Route::get('/hakakses', [App\Http\Controllers\HakaksesController::class, 'index'])->name('hakakses.index')->middleware('superadmin');
    Route::get('/hakakses/edit/{id}', [App\Http\Controllers\HakaksesController::class, 'edit'])->name('hakakses.edit')->middleware('superadmin');
    Route::put('/hakakses/update/{id}', [App\Http\Controllers\HakaksesController::class, 'update'])->name('hakakses.update')->middleware('superadmin');
    Route::delete('/hakakses/delete/{id}', [App\Http\Controllers\HakaksesController::class, 'destroy'])->name('hakakses.delete')->middleware('superadmin');

    Route::get('/prodi', [App\Http\Controllers\ProdiController::class, 'index'])->name('prodi.index');
    Route::get('/prodi/create', [App\Http\Controllers\ProdiController::class, 'create'])->name('prodi.create');
    Route::post('/prodi/store', [App\Http\Controllers\ProdiController::class, 'store'])->name('prodi.store');
    Route::get('/prodi/edit/{id}', [App\Http\Controllers\ProdiController::class, 'edit'])->name('prodi.edit');
    Route::put('/prodi/update/{id}', [App\Http\Controllers\ProdiController::class, 'update'])->name('prodi.update');
    Route::delete('/prodi/delete/{id}', [App\Http\Controllers\ProdiController::class, 'destroy'])->name('prodi.delete');

    Route::get('/pt', [App\Http\Controllers\PtController::class, 'index'])->name('pt.index');
    Route::get('/pt/create', [App\Http\Controllers\PtController::class, 'create'])->name('pt.create');
    Route::post('/pt/store', [App\Http\Controllers\PtController::class, 'store'])->name('pt.store');
    Route::get('/pt/edit/{id}', [App\Http\Controllers\PtController::class, 'edit'])->name('pt.edit');
    Route::put('/pt/update/{id}', [App\Http\Controllers\PtController::class, 'update'])->name('pt.update');
    Route::delete('/pt/delete/{id}', [App\Http\Controllers\PtController::class, 'destroy'])->name('pt.delete');

    Route::get('/ptprodi', [App\Http\Controllers\PtprodiController::class, 'index'])->name('ptprodi.index');
    Route::get('/ptprodi/create', [App\Http\Controllers\PtprodiController::class, 'create'])->name('ptprodi.create');
    Route::post('/ptprodi/store', [App\Http\Controllers\PtprodiController::class, 'store'])->name('ptprodi.store');
    Route::get('/ptprodi/edit/{id}', [App\Http\Controllers\PtprodiController::class, 'edit'])->name('ptprodi.edit');
    Route::put('/ptprodi/update/{id}', [App\Http\Controllers\PtprodiController::class, 'update'])->name('ptprodi.update');
    Route::delete('/ptprodi/delete/{id}', [App\Http\Controllers\PtprodiController::class, 'destroy'])->name('ptprodi.delete');

    Route::get('/batch', [App\Http\Controllers\BatchController::class, 'index'])->name('batch.index');
    Route::get('/batch/create', [App\Http\Controllers\BatchController::class, 'create'])->name('batch.create');
    Route::post('/batch/store', [App\Http\Controllers\BatchController::class, 'store'])->name('batch.store');
    Route::get('/batch/edit/{id}', [App\Http\Controllers\BatchController::class, 'edit'])->name('batch.edit');
    Route::put('/batch/update/{id}', [App\Http\Controllers\BatchController::class, 'update'])->name('batch.update');
    Route::delete('/batch/delete/{id}', [App\Http\Controllers\BatchController::class, 'destroy'])->name('batch.delete');

    Route::get('/yudisium', [App\Http\Controllers\YudisiumController::class, 'index'])->name('yudisium.index');
    Route::get('/yudisium/create', [App\Http\Controllers\YudisiumController::class, 'create'])->name('yudisium.create');
    Route::post('/yudisium/store', [App\Http\Controllers\YudisiumController::class, 'store'])->name('yudisium.store');
    Route::get('/yudisium/edit/{id}', [App\Http\Controllers\YudisiumController::class, 'edit'])->name('yudisium.edit');
    Route::put('/yudisium/update/{id}', [App\Http\Controllers\YudisiumController::class, 'update'])->name('yudisium.update');
    Route::delete('/yudisium/delete/{id}', [App\Http\Controllers\YudisiumController::class, 'destroy'])->name('yudisium.delete');

    Route::get('/detail', [App\Http\Controllers\DetailController::class, 'index'])->name('detail.index');
    Route::get('/detail/create', [App\Http\Controllers\DetailController::class, 'create'])->name('detail.create');
    Route::post('/detail/store', [App\Http\Controllers\DetailController::class, 'store'])->name('detail.store');
    Route::get('/detail/edit/{id}', [App\Http\Controllers\DetailController::class, 'edit'])->name('detail.edit');
    Route::put('/detail/update/{id}', [App\Http\Controllers\DetailController::class, 'update'])->name('detail.update');
    Route::delete('/detail/delete/{id}', [App\Http\Controllers\DetailController::class, 'destroy'])->name('detail.delete');

    Route::get('/table-example', [App\Http\Controllers\ExampleController::class, 'table'])->name('table.example');
    Route::get('/clock-example', [App\Http\Controllers\ExampleController::class, 'clock'])->name('clock.example');
    Route::get('/chart-example', [App\Http\Controllers\ExampleController::class, 'chart'])->name('chart.example');
    Route::get('/form-example', [App\Http\Controllers\ExampleController::class, 'form'])->name('form.example');
    Route::get('/map-example', [App\Http\Controllers\ExampleController::class, 'map'])->name('map.example');
    Route::get('/calendar-example', [App\Http\Controllers\ExampleController::class, 'calendar'])->name('calendar.example');
    Route::get('/gallery-example', [App\Http\Controllers\ExampleController::class, 'gallery'])->name('gallery.example');
    Route::get('/todo-example', [App\Http\Controllers\ExampleController::class, 'todo'])->name('todo.example');
    Route::get('/contact-example', [App\Http\Controllers\ExampleController::class, 'contact'])->name('contact.example');
    Route::get('/faq-example', [App\Http\Controllers\ExampleController::class, 'faq'])->name('faq.example');
    Route::get('/news-example', [App\Http\Controllers\ExampleController::class, 'news'])->name('news.example');
    Route::get('/about-example', [App\Http\Controllers\ExampleController::class, 'about'])->name('about.example');
});