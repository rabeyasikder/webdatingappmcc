<?php

namespace App\Http\Controllers;
use App\User;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(User $user)
    {
        $user = Auth::user();
        return view('create', compact('user'));
    }



//    public function store(){
//
//        //$this->authorize('update', $user->profile);
//        $data = request()->validate(
//            [
//
//                'image'=> ['required', 'image'],
//                'gender' =>'required',
//                'dateofbirth' =>'required',
//                'address' => 'required',
//                'lat' => 'required',
//                'lng' => 'required',
//            ]
//        );
//
//       // dd($data);
//        $imagePath= request('image')->store('profile','public');
//        $image = Image::make(public_path("storage/{$imagePath}"))->fit(250,250);
//
//        $image->save();
//        auth()->user()->profile()->create(
//            [
//                'image' => $imagePath,
//                'gender' =>$data['gender'],
//                'dateofbirth' =>$data['dateofbirth'],
//                'address' => $data['address'],
//                'lat' => $data['lat'],
//                'lng' => $data['lng'],
//                'user_id' => auth()->user()->id
//
//            ]
//        );
//        return redirect()->back();
//       // return redirect()->route('create');
//       // return redirect('/create/' . auth()->user()->id);
//
//    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'gender' =>'required',
            'dateofbirth' =>'required',
            'address' => 'required',
            'lat' => 'required',
            'lng' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $imagePath= request('image')->store('profile','public');
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(250,250);

        $image->save();
//dd($validator);
        auth()->user()->profile()->create(
        [
                'image' => $imagePath,
                'gender' =>$request->input('gender'),
                'dateofbirth' =>$request->input('dateofbirth'),
                'address' => $request->input('address'),
                'lat' => $request->input('lat'),
                'lng' => $request->input('lng'),
                'user_id' => auth()->user()->id

            ]);

        return redirect()->back();
    }


    public function show(){

        $lat = Auth::user()->lat;
        $lng = Auth::user()->lng;
        $radius = 5;

        $string = "SELECT id,image, gender, dateofbirth, address , ( 6371 * acos( cos( radians(?) ) *
        cos( radians( lat ) ) * cos( radians( lng ) - radians(?) ) + sin( radians(?) ) * sin( radians( lat ) ) ) )
        AS distance FROM profiles HAVING distance < ? ORDER BY distance LIMIT 0 , 20;";

        $args = [$lat, $lng, $lat, $radius];

        $data = DB::select($string, $args);

        return ($data) ? $data : null;


        return view('profiles.index',compact('data'));
    }
}
