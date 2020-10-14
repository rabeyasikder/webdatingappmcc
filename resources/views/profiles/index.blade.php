@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-3 p-5">
            <img src="{{ $user->profile->profileImage()}}" class="rounded-circle" style="height: 120px">
        </div>

        <div class="col-9 pt-5 pb-5">
            <div class="d-flex justify-content-between align-baseline">
                <h1>{{$user->username}}</h1>

                @can('update', $user->profile)
                    <a href="/p/create">Add post</a>
                @endcan
            </div>

                @can('update', $user->profile)
                <a href="/profile/{{$user->id}}/edit">Edit Profile</a>
                @endcan


            <div class="d-flex pr-2">
                <div class="pr-5"><strong>{{$user->posts->count()}}</strong> Comment</div>
                <div class="pr-5"><strong>54.4k</strong> Like</div>
                <div class="pr-5"><strong>281</strong> Unlike</div>
            </div>

            <div class="pt-4">
               <p>Gender: {{$user->profile->gender}}</p>
            </div>
            <div class="">
               <p>Date of Birth: {{$user->profile->dateofbirth}}</p>
            </div>

            <div class="">
                <p>Address: {{$user->profile->address}}</p>

        </div>

    </div>

{{--    <div class="row">--}}

{{--        @foreach($user->posts as $post)--}}
{{--            <div class="col-4">--}}
{{--                <a href="/p/{{$post->id}}">--}}
{{--                    <img src="/storage/{{$post->image}}" >--}}
{{--                </a>--}}

{{--            </div>--}}
{{--        @endforeach--}}

{{--    </div>--}}
</div>
@endsection
