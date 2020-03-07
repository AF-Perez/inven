<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\UserRepository;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = \App\User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request, UserRepository $userRepository)
    {   
        // se almacena el usuario
        $user = $userRepository->create($request);

        // se le asigna un rol al usuario
        // $user->assignRole($request->input('roles'));

        // token del usuario
        // $token = app(\Illuminate\Auth\Passwords\PasswordBroker::class)->createToken($user);

        // se le envia un email al usuario con un enlace para que establezca su clave
        // $user->sendPasswordResetNotification($token);

        return redirect()->route('users.index')
            ->with('success','Registro creado con exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = \App\User::find($id);

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = \App\User::find($id);
        return view('users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, UserRepository $userRepository, $id)
    {
        // se actualiza el usuario
        $user = $userRepository->update($request, $id);

        // se borra todos los roles previos
        // DB::table('model_has_roles')->where('model_id',$id)->delete();

        // se asigna los roles nuevos
        // $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
                        ->with('success','Registro actualizado con exito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // obtencion de referencias a las tablas a eliminar
        $user = \App\User::find($id);
      
        $user->delete();

        return redirect()->route('users.index')
                        ->with('success','Registro eliminado con exito.');
    }

    public function ingresar()
    {
        return view('users.create-regular-user');
    }

    public function guardar(Request $request)
    {
        // se almacena el usuario
        // $user = $userRepository->create($request);

        $user = new \App\User();
        $user->email = $request->input('email');
        $user->nombres = $request->input('nombres');
        $user->apellidos = $request->input('apellidos');
        $user->cedula = $request->input('cedula');
        $user->password = Hash::make(str_random(8));

        $user->save();

        // se le asigna un rol al usuario
        // $user->assignRole($request->input('roles'));

        // token del usuario
        // $token = app(\Illuminate\Auth\Passwords\PasswordBroker::class)->createToken($user);

        // se le envia un email al usuario con un enlace para que establezca su clave
        // $user->sendPasswordResetNotification($token);

        return redirect()->route('users.index')
            ->with('success','El usuario ha sido creado con exito y se le enviara un email con las instrucciones de activacion.');
    }
}
