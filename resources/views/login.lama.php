@extends('layout')
@section('content')
<!DOCTYPE html>
<div class="container"><br>
        <div class="col-md-4 col-md-offset-4 m-auto bg-light p-3 rounded ">
            <h2 class="text-center"><br>Halaman Login </h2>
            <hr>
            {{-- <form action="{{ route('login') }}" method="post"> --}}
                <form>
                <div class="form-group">
                        <label>Username</label>
                        <input type="username" name="username" class="form-control" placeholder="Username" required="">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Email" required="">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password" required="">
                </div>
                <div class="form-group mt-2">
                    <center>
                        <button type="submit" class="btn btn-primary btn-block mb-3">Log In</button>
                        <br>
                        <span>Don't have an account? <a href="/register">Register</a> Now!</span>
                    </center>
                </div>
                
                {{ session('berhasil') }}
                
            </form>
        </div>
</div>