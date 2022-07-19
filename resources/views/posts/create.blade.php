@extends('layouts.app')

@section('title', '| Criar Post')

@section('content')
    
    @include('components.navbar');
    <div class="min-vh-100 d-flex justify-content-center align-items-center">
        
        <form action="/posts" method="post" class="mw-100" enctype="multipart/form-data">

            @csrf
            <h1 class="text-secondary text-center mb-5">Criar Post</h1>

            <input class="form-control mb-3" type="file" name="photo" accept="image/*">
            <textarea class="form-control mb-3" name="description" placeholder="Descrição" rows="3"></textarea>
            <button type="submit" class="btn btn-primary">Enviar</button>

        </form>


    </div>
@endsection
