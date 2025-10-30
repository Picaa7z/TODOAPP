@extends('layout')

@section('content')
    @if (Session::get('notAllowed'))
        <div class="alert alert-danger">
            {{ Session::get('notAllowed') }}
        </div>
    @endif

    @if (Session::get('addTodo'))
        <div class="alert alert-success">
            {{ Session::get('addTodo') }}
        </div>
    @endif

    @if (Session::get('succesDelete'))
        <div class="alert alert-warning">
            {{ Session::get('succesDelete') }}
        </div>
    @endif

    @if (session('done'))
        <div class="alert alert-success">
            {{ session('done') }}
        </div>
    @endif

    <div class="container mt-5">
        <table class="table table-success table-striped table-bordered">
            <tr>
                <td>No</td>
                <td>Kegiatan</td>
                <td>Deskripsi</td>
                <td>Batas Waktu</td>
                <td>Status</td>
                <td>Aksi</td>
            </tr>
            @php $no = 1; @endphp
            @foreach ($todos as $todo)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $todo['title'] }}</td>
                    <td>{{ $todo['description'] }}</td>
                    <td>{{ \Carbon\Carbon::parse($todo['date'])->format('j F, Y') }}</td>
                    <td>{{ $todo['status'] == 1 ? 'Completed' : 'On-Process' }}</td>
                    <td class="d-flex">
                        <div class="me-2">
                            <a href="{{ route('todo.edit', $todo['id']) }}" class="btn btn-primary">Edit</a>
                        </div>
                        <form action="{{ route('todo.destroy', $todo['id']) }}" method="POST" class="me-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-warning">Hapus</button>
                        </form>
                        @if ($todo['status'] == 0)
                            <form action="{{ route('todo.update-completed', $todo['id']) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-success">Completed</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
