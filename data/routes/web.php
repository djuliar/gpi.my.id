<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('filament.admin.auth.login');
});

Route::get('/login', function () {
    return redirect()->route('filament.admin.auth.login');
})->name('login');

Route::middleware(['auth'])->group(function () {
    Route::get('/bkpm/{code}', [PdfController::class, 'printCover'])->name('bkpm.cover.print');
    Route::get('/bkpm/event/{code}/{id}', [PdfController::class, 'printEvent'])->name('bkpm.event.print');
    Route::get('/rps/cover/{code}', [PdfController::class, 'printRpsCover'])->name('rps.cover.print');
    Route::get('/tespdf', function(){
        $html = \Illuminate\Support\Facades\View::make('preview'
        )->render();
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadHTML($html)->setPaper('a4', 'portrait');
        return $pdf->stream('test.pdf');
    });
});
