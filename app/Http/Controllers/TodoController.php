<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Hash;
use Illuminate\support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = Todo::where('user_id', '=', Auth::user()->id)->get();
        return view('dashboard.index', compact('todos'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Menampilkan halaman input form tambah data
        return view('dashboard.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validasi form
        $request->validate([
            'title' => 'required|min:3',
            'date' => 'required',
            'description' => 'required|min:8',
        ]);

        // kirim data ke database yg table todos : model Todo
        // yg ' ' = nama column
        // yg $request-> = value name di input
        // kenapa kirim 5 data pdhl di input ada 3 inputan? kalau dicek di table todos itu kan ada 6 column yg harus diisi, salah satunya column done_date yg nullable, kalau nullable itu gausa diisi gpp jd ga diisi dulu
        // user_id ngambil id dari fitur auth (history login), supaya tau itu todo punya siapa
        // cloumn status kan boolean, jd klo status si todo blm dikerjain = 0
        Todo::create([
            'title' => $request->title,
            'date' => $request->date,
            'description' => $request->description,
            'user_id' => Auth::user()->id,
            'status' => 0,
        ]);

        // kalau berhasil tambah ke db, bakal diarahin ke halaman dashboard dengan menampilkan pemberitahuan
        return redirect()->route('todo.index')->with('addTodo', 'Berhasil menambahkan data Todo!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $todo = Todo::where('id',$id)->first();
        return view ('dashboard.edit', compact ('todo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:3',
            'date' => 'required',
            'description' => 'required|min:8',
        ]);

        Todo::where('id', $id)->update([
            'title' => $request->title,
            'date' => $request->date,
            'description' => $request->description,
            'user_id' => Auth::user()->id,
            'status' => 0,
        ]);

        return redirect()->route('todo.index')->with('succesUpdate', 'Berhasil mengubah data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Todo::where('id', $id)->delete();
        return redirect()->route('todo.index')->with('succesDelete', 'Berhasil menghapus data ToDo!');
    }

    public function login()
    {
        return view('dashboard.login');
    }
    
    public function register()
    {
        return view('dashboard.register');    
    }

    public function registerAccount(Request $request)
    {
        // validasi input
        $request->validate([
            'email' => 'required|email:dns',
            'username' => 'required|min:4|max:8',
            'password' => 'required|min:4',
            'name' => 'required|min:3',
        ]);

        // input data ke db
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // redirect kemana setelah berhasil tambah data + dikirim pemberitahuan
        return redirect('/')->with('succes', 'berhasil menambahkan akun! silahkan login');
    }
public function auth(Request $request)
{
    $request->validate([
        'username' => 'required|exists:users,username',
        'password' => 'required',
    ],[
        'username.exists' => "This username doesn't exists"
    ]);

    $user = $request->only('username', 'password');
    if (Auth::attempt($user)) {
        return redirect()->route('todo.index');
    } else {
        // dd('salah');
        return redirect('/')->with('fail', "Gagal login, periksa dan coba lagi!");
    }
}
public function logout()
{
    Auth::logout();
    return redirect('/');
}
public function updateToCompleted($id)
{
    // cari data yang akan diupdate
    // baru setelahnya data di update ke database melalui model
    Todo::where('id', '=', $id)->update([
        'status' => 1,
        'done_time' => \Carbon\Carbon::now(),
    ]);
    return redirect()->back()->with('done', 'ToDo telah selesai dikerjakan!');
}
}
