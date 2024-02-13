@extends('layouts.layout')
@section('title', 'Wishlist')

@section('content')
<h1>Wishlist</h1>
@if(session('success'))
    <div style="color: green;">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div style="color: red;">{{ session('error') }}</div>
@endif

@if($wishlistProducts->isNotEmpty()) 
    <ul>
        @foreach($wishlistProducts as $wishlist) 
          @foreach($wishlist->products as $product) 
            <li>
                {{ $product->name }} - ${{ $product->price }} 
                                <form action="{{ route('wishlist.remove', ['productId' => $product->id]) }}" method="post">
                    @csrf
                    <button type="submit">Quitar de Wishlist</button>
                  </form>
            </li>
          @endforeach
        @endforeach
    </ul>
@else
    <p>No hay productos en la Wishlist.</p>
@endif

@endsection