<?php

namespace App\Http\Controllers;

use App\User;
use App\Profile;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use function GuzzleHttp\Promise\all;

class ProfileController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(\App\User $user){

       //$user = User::findOrFail($user);
       // $s= Profile::all();
        return view('profiles.index', compact('user'));

    }


    public function edit(User $user){
        $this->authorize('update', $user->profile);
       return view('profiles.edit', compact('user'));
    }




    public function update(\App\User $user){

        $this->authorize('update', $user->profile);
        $data = request()->validate([

            'gender' =>'required',
            'dateofbirth' =>'required',
            'address' => 'required',
            'image'=> '',

        ]);

       // dd($data);
        if (request('image')) {
            $imagePath = request('image')->store('profile', 'public');

            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            $image->save();

            $imageArray = ['image' => $imagePath];
        }
       // dd($data);
       auth()->user()->profile->update(array_merge(
            $data,
           $imageArray ?? []

        ));

        return redirect("/profile/{$user->id}");
    }
}
