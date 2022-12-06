@extends('layout')

@section('content')
    <form action="/store" method="POST" style="max-width: 500px; margin: auto;">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @csrf
        
        <div class="d-flex flex-column">
            <label>Title</label>
            <input type="text" name="title">
        </div>
        <div class="d-flex flex-column">
            <label>Date</label>
            <input type="date" name="date">
        </div>
        <div class="d-flex flex-column">
            <label>Description</label>
        <textarea name="description" cols="30" rows="10"></textarea>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

