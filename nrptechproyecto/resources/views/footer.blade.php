@extends('layouts.app') <!-- Asegúrate de tener un layout base para tus vistas -->

@section('content')
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .footer {
            background-color: #f4f4f4;
            padding: 20px;
            text-align: center;
        }

        .footer h3 {
            margin-bottom: 10px;
        }

        .footer ul {
            list-style: none;
            padding: 0;
        }

        .footer ul li {
            margin-bottom: 5px;
        }

        .back-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Estilos para la versión de escritorio */
        @media (min-width: 768px) {
            .footer ul {
                display: flex;
                justify-content: space-between;
            }

            .footer ul li {
                flex: 1;
            }
        }

        /* Estilos para la versión móvil */
        @media (max-width: 767px) {
            .footer ul {
                display: block;
            }

            .footer ul li {
                margin-bottom: 10px;
            }
        }

    </style>
 <div class="back-to-top" id="backToTop">Volver arriba</div>
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
        <script>
            // JavaScript para el botón "Volver arriba"
            const backToTopButton = document.getElementById('backToTop');
    
            backToTopButton.addEventListener('click', () => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        </script>