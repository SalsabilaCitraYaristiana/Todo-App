<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //menampilkan halaman awal dan menampilkan semua data
        return view('login');
    }
    
    public function register()
    {
        return view('register');
    }

    public function dashboard()
    {
        //menampilkan halaman form input tambah data
        return view('dashboard');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //menampilkan halaman form input tambah data
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validasi form
        $request->validate([
            'title' => 'required|min:3',
            'date' => 'required',
            'description' => 'required|min:8',
        ]);
        //kirim data ke database yang tabel todos : model Todo
        //yg ' 6' = nama column
        //yg $request-> = value name di input
        //kenapa kirim 5 data pdhl input ada 3 inputan? kalau di cek di table todos itu kan ada 6 column yang harus diisi, salah satunya column done_date yg nullable, kalau nullable itu gausah diisi gpp jdi ga diisi dulu
        //user_id ngambil id dari fitur auth (history login), supaya tau itu todo punya siapa
        //column status kan boolean, jd kalo status si todo blm dikerjain = 0
        Todo::create([
            'title' => $request->title,
            'date' => $request->date,
            'description' => $request->description,
            'user_id' => Auth::user()->id,
            'status' => 0,
        ]);
        // kalau berhasil tambah ke dashboard, bakal diarahin ke halaman dashboard dengan menampilkan pemberitahuan
        return redirect('/dashboard')->with('addTodo', 'Berhasil menambahkan data Todo!');

    }

    public function data()
    {
        //ambil data dari table todos
        $todos = Todo::all();
        //compact untuk mengirim data ke bladenya
        //isi di compact hrs sama kaya variablenya
        return view('data', compact('todos'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //menampilkan satu data spesifik
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //parameter $id mengambil data path dinamis {id}
        //ambil satu baris data yang memiliki value column id sama dengan data path dinamis id yang dikirim ke route
        $todo = Todo::where('id', $id)->first();
        //kemudian arahkan/tampilkan file view yang bernama 
        return view('edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validasi
        $request->validate([
            'title' => 'required|min:3',
            'date' => 'required',
            'description' => 'required|min:8',
        ]);
        //cari baris data yang punya value column id sama dengan id yang dikirim ke route
        Todo::where('id', $id)->update([
            'title' => $request->title,
            'date' => $request->date,
            'description' => $request->description,
            'user_id' => Auth::user()->id,
            'status' => 0,
        ]);
        //kalau berhasil, arahkan ke halaman data dengan 

        return redirect('/data')->with('successUpdate', 'Berhasil mengubah data!');
    }
        //mengupdate data di database
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //cari data yang mau dihapus, kalo ketemu langsung hapus datanya
        Todo::where('id',$id)->delete();
        //kalau berhasil arahin balik ke halaman data dengan pemberitahuan
        return redirect('/data')->with('successDelete', 'Berhasil menghapus data ToDo!');
    }

    public function updateToComplated(Request $request, $id)
    {
        Todo::where('id', '=', $id)->update([
            'status' => 1, 
            'done_time' => \Carbon\Carbon::now(), 
        ]);

        return redirect()->back()->with('done', 'Todo telah selesai dikerjakan');
        }
}
