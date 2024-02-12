@extends('layouts.admin')

@section('title', 'Panel de usuarios')

@section('links')
    <link rel="stylesheet" href="../../css/app.css">
    <script defer src="../../js/app.js"></script>
    <script defer src="../../js/bootstrap.js"></script>
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Users Management</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Roles</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($data as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <label class="badge badge-success text-success">{{ $user->role->name }}</label>
                </td>
                <td>
                    <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}">Edit</a>
                    <form method="POST" action="{{ route('users.destroy', $user->id) }}" style="display:inline">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $data->render() !!}
@endsection
