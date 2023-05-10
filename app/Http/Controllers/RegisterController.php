<?php

namespace App\Http\Controllers;

use App\Models\Member;
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
            'picture'=>'required',
            'first_name'=>'required',
            'last_name'=>'required',
            'middle_name'=>'required',
            'birthdate'=>'required',
            'place_of_birth'=>'required',
            'house_no'=>'required',
            'street'=>'required',
            'barangay'=>'required',
            'occupation'=>'required',
            'position'=>'required',
            'contact_number' => 'required',
        ]);

        $image = $data['picture']->store('public');
        $imageArray = explode('/', $image);
        $imageEnd = end($imageArray);
        $data['picture'] = $imageEnd;
        $member = Member::create($data);
        return back()->withSuccess('Successfully registered!');
    }
}
