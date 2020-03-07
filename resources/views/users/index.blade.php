@extends('layouts.admin')

@section('content')

<div class="card">

<div class="card-content">

  {{-- Alert --}}
  @if ($message = Session::get('success'))
      <div class="notification is-info">
        <button class="delete"></button>
          {{ $message }}
      </div>
  @endif

  <!-- Main container -->
    <nav class="level">
      <!-- Left side -->
      <div class="level-left">
        <div class="level-item">
          <p class="subtitle is-5">
            <strong>Listado de usuarios registrados en el sistema</strong>
          </p>
        </div>
      </div>

      <!-- Right side -->
      <div class="level-right">
        <p class="level-item"><a href="{{ route('regular-users.create') }}" class="button is-success">Registrar usuario</a></p>
      </div>
    </nav>

    <table class="table is-fullwidth is-hoverable">
      <thead>
        <tr>
          <th >Nombre</th>
          <th >Correo electrónico</th>
          <th >Número de cédula</th>
          <th width="280px">Acción</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $user)
        <tr>
          <th><?php if ($user->ha_establecido_contrasenia == false) echo '(Pendiente) ' ?>{{ $user->nombres }} {{ $user->apellidos }}</th>
          <td>{{ $user->email }}</td>
          <td>{{ $user->cedula }}</td>
          <td>
            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                <a class="button is-primary" href="{{ route('users.show', $user->id) }}">Mostrar</a>
                <a class="button is-warning" href="{{ route('users.edit', $user->id) }}">Editar</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="button is-danger">Borrar</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection