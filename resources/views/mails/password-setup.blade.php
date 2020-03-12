@component('mail::message')
Atención **{{$name}}**,  {{-- use double space for line break --}}
El administrador del sistema de inventario del Yavirac ha creado su cuenta.

Por favor, dar clic en el boton para establecer su contraseña
@component('mail::button', ['url' => $link])
Establecer contraseña
@endcomponent
Atentamente,  
Instituto alausí.
@endcomponent