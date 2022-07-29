@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach ($albums as $album )
            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                <div class="bg-white rounded shadow-sm"><img src="/album/{{$album->image}}" alt="" class="img-fluid card-img-top">
                    <div class="p-4">
                        <h5> <a href="#" class="text-dark">{{$album->name}}</a></h5>
                        <p class="small text-muted mb-0">{{substr($album->description,0,100)}}</p>
                        <div class="d-flex align-items-center justify-content-center rounded-pill bg-light px-3 py-2 mt-4">
                            <div class="badge badge-danger px-3 rounded-pill font-weight-normal"><a href="{{route('gallery.view',[$album->slug,$album->id])}}">View</a></div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
