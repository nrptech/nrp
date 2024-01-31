
      <!DOCTYPE html>
      <html lang="en">
      <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
            <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
          />
          <script defer
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
          ></script>
      
          <script defer
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
          ></script>
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
      <h2> Show Product</h2>
      </div>
      <div class="pull-right">
      <a class="btn btn-primary" href="{{ route('productos.index') }}"> Back</a>
      </div>
      </div>
      </div>
      
      
      <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="form-group">
      <strong>Name:</strong>
      {{ $product->name }}
      </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="form-group">
      <strong>Details:</strong>
      {{ $product->descripcion }}
      </div>
      </div>
      </div>
      @endsection
      </body>
      </html>