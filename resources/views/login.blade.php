@extends('layout')

@section('content')

 <div class="kotak_login">
    <p class="tulisan_login"><strong>Halaman Login</strong></p>
<form action="{{ route('login-baru') }}" method="POST">
    @csrf
    <div class="emlclass">
        <label>Email</label>
        <input type="email" name="email" class="form_login"  placeholder="Masukkan Email">
    </div>
    <div class="pswdclass">
        <label>Password</label>
        <input type="password" name="password" class="form_login" placeholder="Masukkan Password">
    </div>
    <div class="tmblclass text-center">
        <button type="submit" class="tombol_login">Login</button>
        <br>
        <br>
    <a href="/register">Don't have an account? Register Now!</a>
    </div>



    @if(session('error'))
    {{ session('error') }}
    @endif

    @if(session('isLogin'))
    {{ session('isLogin') }}
    @endif 

    @endsection
</form>