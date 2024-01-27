<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/js/app.js', 'resources/css/app.scss'])
</head>

<body>
    <form action="{{ route('singUps.crear') }}" method="POST">
        @csrf {{-- Cláusula para obtener un token de formulario al enviarlo --}}
        <input type="text" name="name" value="{{ old('name') }}" class="form-control mb-2"
            placeholder="Nombre del usuario" autofocus>
        <input type="text" name="email" value="{{ old('email') }}" class="form-control mb-2"
            placeholder="Email del usuario" autofocus>
        <input type="text" name="password" value="{{ old('password') }}" class="form-control mb-2"
            placeholder="Contraseña del usuario" autofocus>
        <button class="btn btn-primary btn-block" type="submit">
            Sing Up
        </button>
    </form>
    @error('name') <div class="alert alert-danger"> No olvides rellenar el nombre
    </div> @enderror
    @error('email') <div class="alert alert-danger"> No olvides rellenar el email
    </div> @enderror
    @error('password') <div class="alert alert-danger"> No olvides rellenar la contraseña
    </div> @enderror

</body>

</html>