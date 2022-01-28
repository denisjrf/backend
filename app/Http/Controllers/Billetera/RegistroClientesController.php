<?php
/********************************************
 * Creado por Denis Ramirez.
 * Fecha: 26-01-2022.
 * Clase: RegistroClientesController.php
 * Modificado por:
/*********************************************/
namespace App\Http\Controllers\Billetera;

use DB;
use Redirect;
use Session;
use Validator;
use App\Models\Clientes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
/**
 * Registro de Clientes
 */
class RegistroClientesController extends Controller
{
    public function registroClientes(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            "nombre" => "required",
            "apellido" => "required",
            "documento" => "required|integer",
            "email" => "required|email",
            "celular" => "required|string"
        ]);
        if ($validator->fails()) 
        {
            $this->EntityResponse = ["success" => false,"cod_error" => "01", "message_error" => $validator->errors()];
            return response()->json($this->EntityResponse);
        }
        else
        {
            $input = $request->all();
            $cliente = Clientes::create($input);
            if (!empty($cliente)) 
            {
                $this->EntityResponse = ["success" => true, "cod_error" => "00", "message_success" => "Cliente registrado existosamente."];
                return response()->json($this->EntityResponse);
            }
            else
            {
                $this->EntityResponse = ["success" => false,"cod_error" => "01", "message_error" => "Error al registrar el usuario, por favor colocar bien la información y volver a intentar"];
                return response()->json($this->EntityResponse);
            }
        }
    }
}
?>