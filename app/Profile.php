<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
protected $guarded=[];
//    protected $fillable=[
//        'image','gender','dateofbirth','address','lat','lng'
//        ];

    public function profileImage()
    {
        $imagePath = ($this->image) ? $this->image : 'profile/no_profile.png';

        return '/storage/' . $imagePath;
    }
//    public static function boot(){
//        parent::boot();
//        static::created(function ($profile){
//            $profile->profile()->create([
//               // 'gender' => $user->username
//                'lat' => $profile->lat,
//                'lng' =>$profile->lng
//            ]);
//        });
//    }


    public  function user(){
        return $this->belongsTo(User::class);
    }


}
