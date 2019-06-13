<?php
use Illuminate\Support\Facades\Storage;

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

Route::get(
    '{uri}',
    '\\' . Pallares\LaravelNuxt\Controllers\NuxtController::class
)->where('uri', '.*');

Route::get('/excel', function () {
    Excel::load(Storage::url('app/time-sheet.xlsx'), function ($reader) {
        $reader->calculate();
        $sheet = $reader->getActiveSheet();
        // dd($sheet->getCell('D11')->getValue());
        $cell = $sheet->getCell('C13');
        $val = date('h:i', PHPExcel_Shared_Date::ExcelToPHP($cell->getValue()));
        dd($val);
        dd(PHPExcel_Shared_Date::isDateTime($sheet->getCell('D11')));
    });
});