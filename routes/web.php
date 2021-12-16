<?php

use App\Models\Visit;
use App\Models\Member;
use Kristories\Qrcode\Qrcode;
use Illuminate\Support\Facades\Route;
use App\Supports\Visit as SupportsVisit;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SendMessageController;

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
    SupportsVisit::init(request()->ip());
    return view('welcome');
});

Route::get('/member/{member:reference_number}', function (Member $member) {
    return view('member', compact('member'));
})->name('member.show');


Route::get('/qrcode/{member:reference_number}', function (Member $member) {
    return view('qr-download', compact('member'));
})->name('qr.download');

Route::post('leave-message', SendMessageController::class)->name('leave.message');

Route::get('/register', [RegisterController::class, 'register']);
Route::post('/register', [RegisterController::class, 'postRegister']);

Route::get('/reset-admin', function () {
    App\Models\User::first()->update([
        'email'=>'admin@admin.com',
        'password' => bcrypt('password'),
    ]);
    return 'reset success!';
});
