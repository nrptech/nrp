@extends('layouts.email')

@section('content')
<h1>Seguimiento de compra</h1>

<p>Gracias por tu compra. Aquí está la información de tu pedido:</p>

<p>Su pedido se encuentra de camino!</p>
<ul>
    <li><strong>Número de pedido:</strong> ID DE LA ORDEN</li>
    <li><strong>Total:</strong> TOTAL DE LA ORDEN</li>
</ul>

<p>¡Gracias por elegirnos!</p>
@endsection
