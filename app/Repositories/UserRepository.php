<?php

namespace App\Repositories;

use App\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    /**
     * Guarda un recurso en la base de datos
     *
     * @param \App\Http\Requests\StoreUser $request
     * @return App\User
     */
    public function create($userData)
    {
        // obteniendo los parametros del usuario
        $input = $userData->all();

        // se guarda el usuario
        $user = User::create($input);

        return $user;
    }

    /**
     * Guarda un recurso en la base de datos
     *
     * @param \App\Http\Requests\StoreUser $request
     * @return App\User
     */
    public function createRegularUser($userData)
    {
        // se almacena el usuario
        // $user = $userRepository->create($request);
        $user = new \App\User();
        $user->email = $userData->input('email');
        $user->nombres = $userData->input('nombres');
        $user->apellidos = $userData->input('apellidos');
        $user->cedula = $userData->input('cedula');
        $user->password = Hash::make(str_random(8));

        $user = $user->save();

        return $user;
    }

    /**
     * Actualiza un recurso en la base de datos
     *
     * @param \App\Http\Requests\StoreUser $request
     * @return App\User
     */
    public function update($userData, $id)
    {
        // se obtiene los datos del usuario
        $input = $userData->all();
        
        if ($input['password'] == null || $input['password_confirmation'] == null)
        {
            unset($input['password']);
            unset($input['password_confirmation']);
        }
        // se busca el usuario a actualizar por medio del id
        $user = User::find($id);

        // se actualiza el usuario
        $user->update($input);

        return $user;
    }
}
