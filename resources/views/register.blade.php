@extends('layout')
@section('content')
<!DOCTYPE html>
<div class="container"><br>
        <div class="col-md-4 col-md-offset-4 m-auto bg-light p-3 rounded ">
            <h2 class="text-center"><br>Register</h2>
            <hr>
            <form action="{{ route('register') }}" method="POST">    
                
                @foreach ($errors->all () as $error)
                    <li>{{$error}}</li>
                @endforeach
                @csrf

                <div class="form-group">
                    <label>Name</label>
                    <input type="name" name="name" class="form-control" placeholder="Name" required="">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Email" required="">
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="username" name="username" class="form-control" placeholder="Username" required="">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password" required="">
                </div>
                <br>
                        <button type="submit" class="btn btn-primary btn-block mb-3">Register Now</button>
                </div>  
            </form>
            @if(session('berhasil'))
                <button class="btn btn-success">
                    {{ session('berhasil')}}
                </button>
            <br>
            @endif
        </div>
</div>
@endsection