@extends('layouts.layout')

@section('title', 'Ajustes')

@section('content')
    <div>
        <ul>
            <li>{{ $user->name }}</li>
            <li>{{ $user->surname }}</li>
            <li>{{ $user->email }}</li>

            @foreach ($user->payMethods as $payMethod)
                <li>
                    {{ $payMethod->name }}
                </li>
            @endforeach

            @foreach ($user->addresses as $address)
                <li>
                    {{ $address->name }}
                </li>
            @endforeach
        </ul>
        <form method="GET" action="{{ route('profile.edit', $user->name) }}">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <button type="submit" class="btn btn-primary">Editar perfil</button>
        </form>
    </div>
@endsection
