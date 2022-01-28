<?php
/********************************************
 * Creado por Denis Ramirez.
 * Fecha: 26-11-2021.
 * Clase: UserController.php
 * Modificado por:
/*********************************************/
namespace App\Http\Controllers;

use DB;
use Hash;
use Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Correo;
use App\Models\Ciudad;
use App\Models\Estado;
use App\Models\Pais;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(5);
        return view('users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        $pais = Pais::orderBy('id')->get();
        return view('users.create',compact('roles','pais'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'cedula' => 'required|string',
            'fechanac' => 'required|date',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:password_confirmation',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success','Usuario Creado Satisfactoriamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('users.edit',compact('user','roles','userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
        ]);

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success','Usuario Actualizado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success','Usuario Eliminado Correctamente');
    }

    //Funcion para buscar los estados de un pais
    public function Estados(Request $request)
    {
        $estados = Estado::where('id_pais', '=',$request["pais"])->get();
        return $estados;
    }
    //Funcion para buscar las ciudades de un estado
    public function Ciudad(Request $request)
    {
        $ciudad = Ciudad::where('id_estado', '=',$request["estado"])->get();
        return $ciudad;
    }
    //Funcion para mostrar formulario
    public function email(Request $request)
    {
        return view('emails');
    }
    //Funcion para enviar correos
    public function enviarEmail(Request $request)
    {
        $this->validate($request, [
            'asunto' => 'required',
            'destinatario' => 'required|email',
            'cuerpo' => 'required|string',
        ]);
        $input = $request->all();
        $email = Correo::create($input);
        $datosEmail = Correo::where('destinatario', '=', $request["destinatario"])->first();
        Mail::send("emailsEnviado", [
            "datosEmail" => $datosEmail,
        ], function ($message) use ($datosEmail) {
            $message->from("djramirezfr.19@gmail.com", "Un correo de Mailer");
            $message->subject($datosEmail["asunto"]);
            $message->to($datosEmail["destinatario"]);
        });
        return redirect()->route('users.index')
            ->with('success','Email enviado Satisfactoriamente.');
    }
    //Funcion para mostrar los correos enviados
    public function emailsEnviados(Request $request)
    {
        $correos = Correo::orderBy('id','DESC')->get();
        return view('indexEmails',compact('correos')) ->with('i');
    }
}