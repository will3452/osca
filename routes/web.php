<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SendMessageController;
use App\Models\Member;
use App\Models\User;
use App\Supports\Visit as SupportsVisit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
    SupportsVisit::init(request()->ip());
    return view('welcome');
});

Route::post('/login', function (Request $request) {
    $data = $request->validate([
        'email' => ['email', 'exists:users,email', 'required'],
        'password' => ['required',], 
    ]); 


    $user = User::where('email', $data['email'])->first(); 
 

    if ($user !=  null && Hash::check($data['password'],$user->password)) {
        
        auth()->login($user); 
        $user->updated_at = now(); 
        $user->save(); 
        return redirect()->to('/admin/dashboards/main');
    }

    abort(401); 
}); 

Route::get('/member/{ref}', function ($ref) {
    $refArray = explode('!_!zQ', $ref);
    $refNumber = $refArray[0];
    $member = Member::whereReferenceNumber($refNumber)->first();
    return view('member', compact('member'));
})->name('member.show');

Route::get('/qrcode/{ref}', function ($ref) {
    try {
        $rn = explode('!234-_$34', $ref);
        $member = Member::whereReferenceNumber($rn[0])->first();
        return view('qr-download', compact('member'));
    } catch (Exception $e) {
        return $e;
    }
})->name('qr.download');

Route::post('leave-message', SendMessageController::class)->name('leave.message');

Route::get('/register', [RegisterController::class, 'register']);
Route::post('/register', [RegisterController::class, 'postRegister']);

Route::get('/reset-admin', function () {
    App\Models\User::first()->update([
        'email' => 'admin@admin.com',
        'password' => bcrypt('password'),
    ]);
    return 'reset success!';
});

Route::get('/generate-report', function (Request $request) {
    $data = [];
    if ($request->has('from')) {
        $raw = [];
        if (is_null(auth()->user()->barangay)) {
            $raw = Member::whereBarangay($request->barangay)->whereStatus(Member::STATUS_ACTIVE)->whereBetween('created_at', [$request->from, $request->to])->get();
        } else {
            $raw = Member::where('barangay', auth()->user()->barangay)->whereStatus(Member::STATUS_ACTIVE)->whereBetween('created_at', [$request->from, $request->to])->get();
        }

        foreach ($raw as $r) {
            if ($r->birthdate->age >= $request->from_age && $r->birthdate->age <= $request->to_age) {
                $data[] = $r;
            }
        }
    } else {
        if (is_null(auth()->user()->barangay)) {
            $data = Member::whereStatus(Member::STATUS_ACTIVE)->get();
        } else {
            $data = Member::where('barangay', auth()->user()->barangay)->whereStatus(Member::STATUS_ACTIVE)->whereBetween('created_at', [$request->from, $request->to])->get();
        }
    }
    return view('report', compact('data'));
});

Route::get('/id', function (Request $request) {
    $member = Member::findOrFail($request->member);
    return view('gen_id', compact('member'));
});
