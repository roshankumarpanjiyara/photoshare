@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#buzz" role="tab">Followings <span class="badge badge-primary">{{$followings->count()}}</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#references" role="tab">Profile Picture</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#bgpic" role="tab">Background Picture</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active container" role="tabpanel" id="buzz">
                            <br>
                            @foreach ($followings as $follow )
                               <p>
                                    <a href="{{route('user.album',[$follow->userfollow->id])}}"><img src="{{Storage::url($follow->userfollow->profilePic)}}" width="100" alt=""> </a>
                                    Name: {{$follow->userfollow->name}}
                                </p>
                                <p>
                                    @if (Auth::check()&&auth()->user()->id!=$userId)
                                        <follow user-id="{{$userId}}" follows="{{$follows}}"></follow>
                                    @endif
                                </p>
                            @endforeach
                        </div>
                        <div class="tab-pane container" role="tabpanel" id="references"><avatar userid="{{auth()->user()->id}}"></avatar></div>
                        <div class="tab-pane container" role="tabpanel" id="bgpic"><background userid="{{auth()->user()->id}}"></background></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
