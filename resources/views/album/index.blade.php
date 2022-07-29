@extends('layouts.app')

@section('content')
<div class="container">
    <ol class="breadcrumb">
        <h3>Your Album</h3>
        <span style="margin-left: 790px;">
            <a href="{{route('albums.create')}}">
                <button class="btn btn-primary">Create New Album</button>
            </a>
        </span>
    </ol>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <index></index>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
