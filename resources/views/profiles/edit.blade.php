@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/profile/{{$user->id}}" enctype="multipart/form-data" method="post">
        @csrf
        @method('patch');
        <div class="row">
            <h4>Edit Profile</h4>
        </div>
        <div class="row">

            <div class="col-8 offset-2">

                <div class="row">
                    <label for="image" class="col-form-label">Profile Image</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                    @if($errors->has('image'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$errors->first('image')}}</strong>
                       </span>
                    @endif
                </div>


                <div class="form-group row">
                    <div class="col-4 p-0">
                        <label for="name" class="col-form-label text-md-right">Gender</label>

                        <input id="gender" type="text" class="form-control @error('gender') is-invalid @enderror" name="gender" value="{{ old('gender') ?? $user->profile->gender }}" required autocomplete="name" autofocus>

                        @error('gender')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('gender') }}</strong>
                        </span>
                        @enderror

                    </div>

                    <div class="col-8 pl-4 pt-5">
                        <label for="name" class="col-form-label text-md-right">Date of Birth</label>
                        <input style="border: 2px solid #eeeeee" class="datepicker" placeholder="mm/dd/yyyy"  id="dateofbirth"  type="text"   class=" form-control @error('dateofbirth') is-invalid @enderror" name="dateofbirth" value="" required autocomplete="">
                        @error('dateofbirth')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('dateofbirth') }}</strong>
                        </span>
                        @enderror
                    </div>

                </div>

                <div class="form-group row">
                    <label for="name" class="col-form-label text-md-right">location</label>

                    <input id="location" type="text" class="form-control @error('location') is-invalid @enderror" name="location" value="{{ old('location') ?? $user->profile->location}}" required autocomplete="location" autofocus>

                    @error('location')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('location') }}</strong>
                    </span>
                    @enderror

                </div>

                <div class="row pt-3">
                    <button class="btn btn-primary">Save Profile</button>
                </div>

            </div>
        </div>
    </form>
</div>
@endsection
