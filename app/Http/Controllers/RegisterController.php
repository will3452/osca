<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Rules\ValidAge;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register()
    {
        return view("register");
    }
    public function postRegister()
    {
        $data = request()->validate([
            'picture' => 'required',
            'first_name' => ['required', 'string', 'regex:/^[a-zA-Z0-9\s]+$/'],
            'last_name' => ['required', 'string', 'regex:/^[a-zA-Z0-9\s]+$/'],
            'middle_name' => ['required', 'string', 'regex:/^[a-zA-Z0-9\s]+$/'],
            'birthdate' => ['required', new ValidAge],
            'place_of_birth' => 'required',
            'house_no' => 'required',
            'street' => 'required',
            'barangay' => 'required',
            'occupation' => 'required',
            'position' => 'required',
            'contact_number' => ['required', 'min:11', 'max:11'],
        ]);
        /**
         * if (Carbon::parse(request()->birthdate)->age <= 60) {
        return "Invalid Date!";
        }
         */

        $image = $data['picture']->store('public');
        $imageArray = explode('/', $image);
        $imageEnd = end($imageArray);
        $data['picture'] = $imageEnd;
        $member = Member::create($data);
        return redirect('/qrcode/' . $member->reference_number . '?register=success');
        // return back()->withSuccess('Successfully registered!');
    }
}
