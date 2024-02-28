<!doctype html>
<html lang="en">

<head>
    <title>Registro</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    <link rel="stylesheet" href="{{ asset('styles/Login.css') }}">

</head>

<body>
    <section class="h-100 gradient-form">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">

                                    <div class="text-center">
                                        <img src="{{ asset('images/nrp.webp') }}" style="width: 185px;" alt="logo">
                                    </div>

                                    <form action="{{ route('register') }}" method="post">
                                        @csrf
                                        <p>Iniciar sesión:</p>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="formNombre">Nombre</label>
                                            <input value="{{old('name')}}" type="text" name="name" id="formNombre" class="form-control"
                                                placeholder="Ingresar nombre"  />
                                            @error('name')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="formApellido">Apellidos</label>
                                            <input value="{{old('surname')}}" type="text" name="surname" id="formApellido" class="form-control"
                                                placeholder="Ingresar apellidos"  />
                                            @error('surname')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="formEmail">Email</label>
                                            <input value="{{old('email')}}" type="email" name="email" id="formEmail" class="form-control"
                                                placeholder="Correo electrónico"  autocomplete="off" />
                                            @error('email')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="formPass">Contraseña</label>
                                            <input type="password" name="password" id="formPass" class="form-control"
                                                 />
                                            @error('password')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Pass">Confirmar contraseña</label>
                                            <input type="password" name="password_confirmation" id="form2Pass"
                                                class="form-control"  />
                                            @error('password_confirmation')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3"
                                                type="submit">Registrarse</button>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-center pb-4">
                                            <p class="mb-0 me-2">¿Ya tienes cuenta?</p>
                                            <a href="{{ route('login') }}"><button type="button"
                                                    class="btn btn-outline-danger">Iniciar sesión</button></a>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <h4 class="mb-4">NRP tech</h4>
                                    <p class="small mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
                                        do eiusmod
                                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                        quis nostrud
                                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('js/register-validation.js') }}"></script>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>
