<!DOCTYPE html>
<html>
<head>
    <title>Confirmación de Pedido</title>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        .invoice-card {
            border: 1px solid #ced4da;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .invoice-header {
            background-color: #6c99e0;
            color: #050e32;
            padding: 20px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .invoice-body {
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="invoice-card">
                    <div class="invoice-header">
                        <h1 class="mb-0">¡Gracias por tu compra!</h1>
                    </div>
                    <div class="invoice-body">
                        <p class="lead">Estado del pedido: En proceso</p>
                        <p class="lead">El coste total de tu factura es: Una jartá</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
</html>
