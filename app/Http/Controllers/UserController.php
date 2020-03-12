<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegularUser;
use App\Repositories\UserRepository;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;
use App\Mail\PasswordSetupNotification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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

    public function guardar(StoreRegularUser $request, UserRepository $userRepository)
    {
        
        $user = $userRepository->createRegularUser($request);

        // se le asigna un rol al usuario
        // $user->assignRole($request->input('roles'));

        $user = DB::table('users')->where('email', '=', $request->email)
            ->first();

        // token del usuario
        // $token = app(\Illuminate\Auth\Passwords\PasswordBroker::class)->createToken($user);

        //Create Password Reset Token
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => str_random(60),
            'created_at' => Carbon::now()
        ]);

        //Get the token just created above
        $tokenData = DB::table('password_resets')
            ->where('email', $request->email)->latest($column = 'created_at')->first();

        if ($this->sendResetEmail($request->email, $tokenData->token)) {
            return redirect()->route('users.index')
                ->with('success','El usuario ha sido creado con exito y se le envió un email con las instrucciones de activacion.');
        } else {
            return redirect()->back()->withErrors(['error' => trans('A Network Error occurred. Please try again.')]);
        }

    }

    private function sendResetEmail($email, $token)
    {
        //Retrieve the user from the database
        $user = DB::table('users')->where('email', $email)->select('email', 'nombres', 'apellidos', 'cedula')->first();
        //Generate, the password reset link. The token generated is embedded in the link
        $link = url('password/reset/' . $token . '?email=' . urlencode($user->email));

        try {
            //Here send the link with CURL with an external email API 
            Mail::to( $user->email )
            ->send(new PasswordSetupNotification(
                $user->email,
                $user->nombres,
                $user->apellidos,
                $user->cedula,
                $link,
            ));
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function aprobacion()
    {
        return view('aprobacion');
    }
}
