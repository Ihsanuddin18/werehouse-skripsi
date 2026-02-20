<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\LogisticController;
use App\Http\Controllers\InlogisticController;
use App\Http\Controllers\OutlogisticController;
use App\Http\Controllers\LogisticRequestController;

Route::get('/', function () {return redirect()->route('login');});
Route::get('/about', [AboutController::class, 'showAbout'])->name('about');
Route::get('/contact', [ContactController::class, 'showContact'])->name('contact');
Route::post('/submit-form', [ContactController::class, 'submitForm'])->name('submit.form');


Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');
Route::get('post', [HomeController::class, 'post'])->middleware(['auth', 'anggota']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile/{id}/biography', [ProfileController::class, 'updateBiography'])->name('profile.updateBiography');
    Route::delete('/profile/{id}/biography', [ProfileController::class, 'destroyBiography'])->name('profile.destroyBiography');
});


Route::controller(SupplierController::class)->prefix('suppliers')->group(function () {
    Route::resource('suppliers', SupplierController::class);
    Route::get('', 'index')->name('suppliers');
    Route::get('create', 'create')->name('suppliers.create');
    Route::post('store', 'store')->name('suppliers.store');
    Route::get('show/{id}', 'show')->name('suppliers.show');
    Route::get('edit/{id}', 'edit')->name('suppliers.edit');
    Route::put('edit/{id}', 'update')->name('suppliers.update');
    Route::delete('destroy/{id}', 'destroy')->name('suppliers.destroy');
    Route::get('/export_supplier_pdf', [SupplierController::class, 'export_supplier_pdf'])->name('export_supplier_pdf');
    Route::get('/suppliers/{id}/export_show_supplier_pdf', [SupplierController::class, 'export_show_supplier_pdf'])->name('export_show_supplier_pdf');
});


Route::controller(LogisticController::class)->prefix('logistics')->group(function () {
    Route::resource('logistics', LogisticController::class);
    Route::get('', 'index')->name('logistics');
    Route::get('create', 'create')->name('logistics.create');
    Route::post('store', 'store')->name('logistics.store');
    Route::get('show/{id}', 'show')->name('logistics.show');
    Route::get('edit/{id}', 'edit')->name('logistics.edit');
    Route::put('edit/{id}', 'update')->name('logistics.update');
    Route::delete('destroy/{id}', 'destroy')->name('logistics.destroy');
    Route::get('/export_logistic_pdf', [LogisticController::class, 'export_logistic_pdf'])->name('export_logistic_pdf');
    Route::get('/logistics/{id}/export_show_logistic_pdf', [LogisticController::class, 'export_show_logistic_pdf'])->name('export_show_logistic_pdf');
});


Route::controller(InlogisticController::class)->prefix('inlogistics')->group(function () {
    Route::resource('inlogistics', InlogisticController::class);
    Route::get('', 'index')->name('inlogistics');
    Route::get('create', 'create')->name('inlogistics.create');
    Route::post('store', 'store')->name('inlogistics.store');
    Route::get('show/{id}', 'show')->name('inlogistics.show');
    Route::get('edit/{id}', 'edit')->name('inlogistics.edit');
    Route::put('edit/{id}', 'update')->name('inlogistics.update');
    Route::delete('destroy/{id}', 'destroy')->name('inlogistics.destroy');
    Route::get('/export_inlogistic_pdf', [InlogisticController::class, 'export_inlogistic_pdf'])->name('export_inlogistic_pdf');
    Route::get('/inlogistics/{id}/export_show_inlogistic_pdf', [InlogisticController::class, 'export_show_inlogistic_pdf'])->name('export_show_inlogistic_pdf');
});


Route::controller(OutlogisticController::class)->prefix('outlogistics')->group(function () {
    Route::resource('outlogistics', OutlogisticController::class);
    Route::get('', 'index')->name('outlogistics');
    Route::get('create', 'create')->name('outlogistics.create');
    Route::post('store', 'store')->name('outlogistics.store');
    Route::get('show/{id}', 'show')->name('outlogistics.show');
    Route::get('edit/{id}', 'edit')->name('outlogistics.edit');
    Route::put('edit/{id}', 'update')->name('outlogistics.update');
    Route::delete('destroy/{id}', 'destroy')->name('outlogistics.destroy');
    Route::get('/export_outlogistic_pdf', [OutlogisticController::class, 'export_outlogistic_pdf'])->name('export_outlogistic_pdf');
    Route::get('/outlogistics/{id}/export_show_outlogistic_pdf', [OutlogisticController::class, 'export_show_outlogistic_pdf'])->name('export_show_outlogistic_pdf');
});



Route::controller(LogisticRequestController::class)->prefix('logisticrequests')->group(function () {
    Route::resource('logisticrequests', LogisticRequestController::class);
    Route::get('', 'index')->name('logisticrequests');
    Route::post('store', 'store')->name('logisticrequests.store');
    Route::get('/export_logistic_request_pdf', [LogisticRequestController::class, 'export_logistic_request_pdf'])->name('export_logistic_request_pdf');
});



require __DIR__ . '/auth.php';
