@extends('layouts.admin')

@section('title', 'Admin dashboard')

@section('links')
    <link rel="stylesheet" href="{{ asset('css/admin-form.css') }}">
   
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>Add New Product</h2>
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

        <div class="form-container">
            <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" name="name" class="form-control" placeholder="Name">
                </div>

                <div class="form-group">
                    <label for="price" class="form-label">Price:</label>
                    <input type="number" name="price" class="form-control" placeholder="Price" min="1">
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">Description:</label>
                    <input type="text" name="description" class="form-control" placeholder="Description">
                </div>

                <div class="form-group">
                    <label for="stock" class="form-label">Stock:</label>
                    <input type="number" name="stock" class="form-control" placeholder="Stock" min="0">
                </div>

                <div class="form-group">
                    <label for="specs" class="form-label">Specs:</label>
                    <input type="text" name="specs" class="form-control" placeholder="Specs">
                </div>

                <div class="form-group">
                    <label for="features" class="form-label">Features:</label>
                    <input type="text" name="features" class="form-control" placeholder="Features">
                </div>

                <div class="form-group">
                    <label for="tax_id" class="form-label">Tax ID:</label>
                    <input type="number" name="tax_id" class="form-control" placeholder="Tax ID" min="0">
                </div>

                <div class="form-group">
                    <label for="color" class="form-label">Color:</label>
                    <input type="text" name="color" class="form-control" placeholder="Color">
                </div>

                <div class="form-group">
                    <label for="image" class="form-label">Imágenes del Producto</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image">
                </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
