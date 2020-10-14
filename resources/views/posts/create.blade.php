@extends('layouts.app')

@section('content')
<div class="container">
<form action="/p" enctype="multipart/form-data" method="post">
    @csrf
    <div class="row">
        <div class="col-8 offset-2">
            <div class="form-group row">
                <label for="name" class="col-form-label text-md-right">Post Caption</label>

                <input id="caption" type="text" class="form-control @error('caption') is-invalid @enderror" name="caption" value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('caption')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('caption') }}</strong>
                    </span>
                @enderror

            </div>
            <div class="row">
                <label for="image" class="col-form-label">Post Image</label>
                <input type="file" class="form-control-file" id="image" name="image">
                @if($errors->has('image'))
                    <span class="invalid-feedback" role="alert">
                            <strong>{{$errors->first('image')}}</strong>
                       </span>
                @endif
            </div>
            <div class="row pt-3">
                <button class="btn btn-primary"> Add new Post</button>
            </div>

        </div>
    </div>
</form>


</div>
@endsection
