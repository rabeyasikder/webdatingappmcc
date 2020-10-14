@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/user" enctype="multipart/form-data" method="post">
        @csrf

        <div class="row">
            <h4 class="pl-4">Adding Profile Details</h4>
        </div>
        <div class="row">

            <div class="col-8 offset-2">

                <div class="form-group row">
                    <label for="image" class="col-form-label">Profile Image</label>
                    <input type="file" class="form-control-file pb-2" id="image" name="image">
                    @if($errors->has('image'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$errors->first('image')}}</strong>
                       </span>
                    @endif
                </div>

                <div class="form-group row">
                    <div class="col-4 p-0">
                        <label for="gender" class="col-form-label text-md-right">Gender</label>
                        <input id="gender" type="text" class="form-control @error('gender') is-invalid @enderror" name="gender"  required autocomplete="name" autofocus>

                        @error('gender')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('gender') }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-8 pl-4 pt-4">
                        <label for="name" class="col-form-label text-md-right">Date of Birth</label>
                        <input style="border: 2px solid #eeeeee" class="datepicker" placeholder="mm/dd/yyyy"  id="dateofbirth"  type="text"   class=" form-control @error('dateofbirth') is-invalid @enderror" name="dateofbirth"  required autocomplete="">
                        @error('dateofbirth')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('dateofbirth') }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-8 pl-0">
                    <label for="name" class="col-form-label text-md-right">Address</label>

                        <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address"  required autocomplete="address" autofocus>
                    </div>


                    @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('address') }}</strong>
                    </span>
                    @enderror

                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Select the location</h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <span class="error">{{$errors->first('lat')}}</span>
                                    <span class="error">{{$errors->first('lng')}}</span>
                                    <location-component></location-component>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class=" form-group row pt-3">
                    <button class="btn btn-primary">Save Profile Save <i class="fa fa-upload"></i></button>

                    <a class="pl-4" href="/profile/{{$user->id}}/">Show Profile</a>
                </div>

            </div>

        </div>
    </form>
</div>
@endsection




