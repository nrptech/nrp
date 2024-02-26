@extends('layouts.admin')

@section('title', 'Admin dashboard')

@section('links')

@endsection

@section('content')
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

    <h4 class="text-warning"> <strong>{{ $producto->name }}</strong></h4>
    <form method="POST" action="{{ route('productos.updateCategories', $producto->id) }}" enctype="multipart/form-data">

        @method('PUT')
        @csrf


        <div>
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
                <button type="submit" class="btn btn-success">Añadir</button>
            </div>
        </div>

    </form>

    <form method="POST" action="{{ route('productos.deleteCategory', $producto->id) }}" enctype="multipart/form-data">
        @method('PUT')
        {{ csrf_field() }}
    
        @if (count($assignedCategories) > 0)
            <div>
                <div>
                    <h1>Eliminar categorías</h1>
                    <label for="category" class="form-label">Categoría del Producto</label>
                    <select class="form-select" id="category" name="category">
                        @foreach ($assignedCategories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </div>
            </div>
        @endif
    </form>
    
@endsection
