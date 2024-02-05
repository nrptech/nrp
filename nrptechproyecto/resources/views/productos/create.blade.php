<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="../../css/app.css">
    <script defer src="../../js/app.js"></script>
    <script defer src="../../js/bootstrap.js"></script>
</head>

<body>
    @extends('layouts.admin')

    @section('contenido')
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Add New Product</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('productos.index') }}"> Back</a>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" name="name" class="form-control" placeholder="Name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="price" class="form-label">Price:</label>
                        <input type="number" name="price" class="form-control" placeholder="Price">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="description" class="form-label">Description:</label>
                        <input type="text" name="description" class="form-control" placeholder="Description">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="discount" class="form-label">Discount:</label>
                        <input type="number" name="discount" class="form-control" placeholder="Discount">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock:</label>
                        <input type="number" name="stock" class="form-control" placeholder="Stock">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="specs" class="form-label">Specs:</label>
                        <input type="text" name="specs" class="form-control" placeholder="Specs">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="features" class="form-label">Features:</label>
                        <input type="text" name="features" class="form-control" placeholder="Features">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="tax_id" class="form-label">Tax ID:</label>
                        <input type="number" name="tax_id" class="form-control" placeholder="Tax ID">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="color" class="form-label">Color:</label>
                        <input type="text" name="color" class="form-control" placeholder="Color">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="image" class="form-label">Imágenes del Producto</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image">
                    </div>
                </div>
              </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    @endsection
</body>

</html>
