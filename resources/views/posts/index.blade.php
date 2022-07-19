@extends('layouts.app')

@section('title', '| Dashboard')

@section('content')
    
    @include('components.navbar');
    <div class="min-vh-100 d-flex flex-column justify-content-center align-items-center" style="margin-top:80px;">
        
        @foreach ($posts as $post)

        <div class="card mb-3" style="width: 600px;">
        
            <div class="card-header bg-white border-0">
                <span class="fw-bold">{{$post->user->name}}</span>
        </div>

        <img src="{{$post->image}}" class="card-image">

        <div class="card-body">
            <p class="card-text">{{$post->description}}</p>
        </div>

            
        @endforeach

    </div>
@endsection
