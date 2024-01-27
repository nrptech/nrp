<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/js/app.js', 'resources/css/app.scss'])
</head>

<body>
    <h1>Notas desde base de datos</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
            </tr>
        </thead>
        @foreach ($notas as $nota)
        <tr>
            <td>{{$nota -> nombre}}</td>
            <td>{{$nota -> descripcion}}</td>
        </tr>
        @endforeach
    </table>
</body>

</html>