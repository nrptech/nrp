<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
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
                    <h2>Edit Product</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('categories.create') }}"> Create New Category</a>
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


        <form method="POST" action="{{ route('productos.updateCategories', $producto->id) }}"
            enctype="multipart/form-data">

            @method('PUT')
            @csrf

            <div class="mb-3">

                <p>{{ $producto->name }}</p>

                @if (count($assignedCategories) > 0)
                    <div>
                        <h1>Eliminar categorias</h1>
                        <label for="category" class="form-label">Categoría del Producto</label>
                        <select class="form-select" id="category" name="category">
                            @foreach ($assignedCategories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif

                <div>
                    <div>
                        <h1>Añadir categorias</h1>
                        <label for="category" class="form-label">Categoría del Producto</label>
                        <select class="form-select" id="category" name="category">
                            @foreach ($allCategories as $category)
                                @if (!$assignedCategories->contains($category))
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <input type="hidden" name="product_id" value="{{ $producto->id }}">
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
        </form>
    </body>

    </html>
