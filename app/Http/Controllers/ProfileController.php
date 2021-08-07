<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(User $user)
    {
        return view('profile.index', compact('user'));
    }

    public function edit()
    {
        return view('profile.edit');
    }

    public function update(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'age' => 'required|integer',
            'address' => 'required',
            'tel' => 'required',
            'date_of_birth' => 'required',
            'language' => 'required',
        ]);

        $user = auth()->user();

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
        ]);

        $user->profile->update([
            'age'           => $request->age,
            'address'       => $request->address,
            'tel'           => $request->tel,
            'date_of_birth' => Carbon::parse($request->date_of_birth),
            'language'      => $request->language,
        ]);

        if (request()->hasFile('avatar') && request()->file('avatar')->isValid()) {

            $file_extension = request()->avatar->getClientOriginalExtension();
            $file_name = rand().''.$user->id.'.'.$file_extension;

            request()->avatar->move(storage_path('app/public/avatars/'), $file_name);

            $user->avatar = $file_name;
            
            $user->save();
        }

        return redirect()->route('user.profile', auth()->user()->id);
    }
}
