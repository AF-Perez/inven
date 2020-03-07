@extends('layouts.admin')

@section('content')

<div class="card">

    <header class="card-header">
        <p class="card-header-title">
        Ingresar Registro
        </p>
        <a class="card-header-icon" aria-label="more options" href="{{ route('users.index') }}">
            Atrás
        </a>
    </header>

    <div class="card-content">

        {!! Form::open(array('route' => 'regular-users.store', 'method'=>'POST')) !!}

            <div class="field">
                <label class="label">Nombres</label>
                {!! Form::text(
                    'nombres',
                    null,
                    [
                        'placeholder' => 'Nombres',
                        'class' => ($errors->has('nombres')) ? 'input is-danger' : 'input',
                        'id' => 'nombres'
                    ]
                ) !!}
                @error('nombres')
                    <p id="nombresErrorMsg" class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label class="label">Apellidos</label>
                {!! Form::text(
                    'apellidos',
                    null,
                    [
                        'placeholder' => 'Apellidos',
                        'class' => ($errors->has('apellidos')) ? 'input is-danger' : 'input',
                        'id' => 'apellidos'
                    ]
                ) !!}
                @error('apellidos')
                    <p id="apellidosErrorMsg" class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label class="label">Correo electrónico</label>
                {!! Form::email(
                    'email',
                    null,
                    array(
                        'placeholder' => 'Correo electrónico institucional',
                        'class' => ($errors->has('email')) ? 'input is-danger' : 'input',
                        'id' => 'email'
                    )) !!}
                @error('email')
                    <p id="emailErrorMsg" class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label class="label">Número de Cédula</label>
                {!! Form::text(
                    'cedula', null,
                    [
                        'placeholder' => 'Cédula o Pasaporte',
                        'class' => ($errors->has('cedula')) ? 'input is-danger' : 'input',
                        'id' => 'cedula'
                    ]
                ) !!}
                @error('cedula')
                    <p id="cedulaErrorMsg" class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

          <button type="submit" class="button is-primary">Guardar</button>

        {!! Form::close() !!}
    </div>

</div>
        
@section('custom_scripts')
<script>
    function removeErrorFeedbacks(e) {
        e.target.className = 'input';
        if (document.getElementById(e.target.id + 'ErrorMsg') !== null) {
            document.getElementById(e.target.id + 'ErrorMsg').remove();
        }
    } 
    const inputNombres = document.getElementById('nombres');
    inputNombres.addEventListener('input', removeErrorFeedbacks);
    const inputApellidos = document.getElementById('apellidos');
    inputApellidos.addEventListener('input', removeErrorFeedbacks);
    const inputCedula = document.getElementById('cedula');
    inputCedula.addEventListener('input', removeErrorFeedbacks);
    const inputPassword = document.getElementById('password');
    inputPassword.addEventListener('input', removeErrorFeedbacks);
   
</script>
@endsection

@endsection
