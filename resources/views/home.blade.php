@extends('layouts.app')

@section('content')
<div class="container">
    <div class="jumbotron jumbotron-fluid">
        <img src="https://source.unsplash.com/1600x900/?nature,water" style="width: 100%;height: 400px;">
    </div>
    <div class="row">
        @foreach ($albums as $album )
            <div class="col-lg-3">
                <div class="card">
                    <img src="{{asset('album')}}/{{$album->image}}" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title"><center>{{$album->name}}</center></h5>
                        <center>
                            <a href="{{route('gallery.view',[$album->slug,$album->id])}}" class="btn btn-primary">View Album</a>
                        </center>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{$albums->links()}}
</div>
@endsection
