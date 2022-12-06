@extends('layout')

@section('content')
@if (session('successUpdate'))
<div class="alert alert-success">
    {{session('successUpdate')}}
</div>
@endif
@if (session('successDelete'))
<div class="alert alert-warning">
    {{session('successDelete')}}
</div>
@endif
@if (session('successComplated'))
<div class="alert alert-warning">
    {{session('successComplated')}}
</div>
@endif
<table class="table table-success table-striped table-bordered">
    <tr>
        <td>No</td>
        <td>Kegiatan</td>
        <td>Deskripsi</td>
        <td>Batas Waktu</td>
        <td>Status</td>
        <td>Aksi</td>
    </tr>
    @php
        $no = 1;
    @endphp
    @foreach ($todos as $todo)
    <tr>
        {{--tiap di looping, $no bakal ditambah 1 --}}
        <td>{{ $no++ }}</td>        
        <td>{{ $todo['title'] }}</td>        
        <td>{{ $todo['description']}}</td>    
        {{--carbon : package data pada laravel, nntinya si date yg 2022-11-22 formatnya jadi 22 November, 2022--}}    
        <td>{{ \Carbon\Carbon::parse($todo['date'])->format('j F, Y') }}</td>      
        {{--konsep ternary, if statusnya 1 nampilin teks complated kalo 0 nampilin teks on-process, status tuh boolean kan? cmn antara 1 atau 0--}}  
        <td>{{ $todo['status'] == 1 ? 'Complated' : 'On-Process' }}</td> 
        <td>       
            {{--karena path {id} merupakan path dinamis, jadi kita harus isi path dinamis tersebut, karena kita mengisinya dengan data dinamis/data dari database jd buat isi nya pake kurung kurawal dua kali--}}
            <a href="/edit/{{$todo['id']}}">Edit</a>
            {{--fitur delete harus menggunakan form lagi, tombol hapusnya disimpan di tag button--}}
            <form action="/delete/{{$todo['id']}}" method="POST">
            @csrf
            {{--menyimpan method="POST", karena di route nya menggunakan method delete--}}
            @method('DELETE')
            <button type="submit" >Hapus</button>
            </form>
            {{--button hanya muncul ketika statusnya msih on-process (0)--}}
            @if ($todo['status'] == 0)
            <form action="/complated/{{$todo['id']}}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-success">Complated</button>
            </form>
            @endif
        </td>
    </tr>
    @endforeach
</table>
@endsection