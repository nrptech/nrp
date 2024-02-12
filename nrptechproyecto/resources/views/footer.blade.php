@extends('layouts.app') <!-- Asegúrate de tener un layout base para tus vistas -->

@section('content')
    <div class="footer">
        <h3>Contacto</h3>
        <ul>
            <li>Centro de soporte</li>
            <li>Email</li>
            <li>Dirección</li>
        </ul>
        <h3>Comunidad</h3>
        <ul>
            <li>Redes sociales</li>
            <li>Instagram</li>
            <li>X</li>
            <li>Blog</li>
        </ul>
        <h3>Otros</h3>
        <ul>
            <li>Black Friday</li>
            <li>Cyber Monday</li>
            <li>PcDays</li>
        </ul>
        <h3>Métodos de pago</h3>
        <ul>
            <li>Iconos de bancos</li>
        </ul>
    </div>
<script src="{{ asset('js/footer.js') }}"></script>

@endsection