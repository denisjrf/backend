<?php  
/********************************************
 * Creado por Denis Ramirez.
 * Fecha: 27-01-2022.
 * Clase: BilleteraController.php
 * Modificado por:
/*********************************************/
namespace App\Http\Controllers\Billetera;

use DB;
use Mail;
use Redirect;
use Session;
use Validator;
use App\Models\Billetera;
use App\Models\Billeterapagos;
use App\Models\Clientes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
/**
 * 
 */
class BilleteraController extends Controller
{
	public function recargarBilletera(Request $request)
    {
    	$params = $request->only("documento", "celular", "valor");
        $validator = Validator::make($request->all(),
        [
            "documento" => "required|integer",
            "celular" => "required|string",
            "valor" => "required|numeric"
        ]);
        if ($validator->fails()) 
        {
            $this->EntityResponse = ["success" => false,"cod_error" => "01", "message_error" => $validator->errors()];
            return response()->json($this->EntityResponse);
        }
        else
        {
            $buscarCliente = Clientes::where("documento", "=", $params["documento"])->first();
            if (!empty($buscarCliente)) 
            {
                $id_cliente = $buscarCliente->id;
                $query = new Billetera();
                $query->id_cliente = $id_cliente;
                $query->documento = $params["documento"];
                $query->celular = $params["celular"];
                $query->valor = $params["valor"];
                $query->save();
                if (!empty($query)) 
                {
                	$this->EntityResponse = ["success" => true, "cod_error" => "00", "message_success" => "Recarga billetera éxitoso."];
                	return response()->json($this->EntityResponse);
                }
                else
                {
                	$this->EntityResponse = ["success" => false,"cod_error" => "01", "message_error" => "Transacción Fallida, favor volver a intentar."];
                	return response()->json($this->EntityResponse);
                }
            }
            else
            {
                $this->EntityResponse = ["success" => false,"cod_error" => "01", "message_error" => "El cliente ingresado no existe, favor colocar un número de documento válido."];
                return response()->json($this->EntityResponse);
            }
        }
    }
    public function pagarCompra(Request $request)
    {
        $params = $request->only("documento", "monto");
        $validator = Validator::make($request->all(),
        [
            "documento" => "required|integer",
            "monto" => "required|numeric",
        ]);
        if ($validator->fails()) 
        {
            $this->EntityResponse = ["success" => false,"cod_error" => "01", "message_error" => $validator->errors()];
            return response()->json($this->EntityResponse);
        }
        else 
        {
            $validarCliente = Clientes::where("documento", "=", $params["documento"])->first();
            if (!empty($validarCliente)) 
            {
                $id_cliente = $validarCliente->id;
                $celular = $validarCliente->celular;
                $email = $validarCliente->email;
                $nombre = $validarCliente->nombre;
                $apellido = $validarCliente->apellido;
                $id = rand(1,99);
                Session::put('UsuarioSessionId', $id);
                $validarSaldo = Billetera::where("id_cliente", "=", $id_cliente)->first();
                if (!empty($validarSaldo)) 
                {
                    $saldo = $validarSaldo->valor;
                    if ($saldo > 0) 
                    {
                        $id_session = Session::get("UsuarioSessionId");
                        $token = rand(1,999999);

                        $query = new Billeterapagos();
                        $query->id_session = $id_session;
                        $query->token = $token;
                        $query->monto = $params["monto"];
                        $query->documento = $params["documento"];
                        $query->celular = $celular;
                        $query->save();
                        if (!empty($query)) 
                        {
                            $datos["id_session"] = $id_session;
                            $datos["token"] = $token;
                            $datos["documento"] = $params["documento"];
                            $datos["celular"] = $celular;
                            $datos["monto"] = $params["monto"];
                            $datos["nombre"] = $nombre;
                            $datos["apellido"] = $apellido;
                            $datos["email"] = $email;
                            Mail::send("billetera.emailsEnviado", [
                                "datos" => $datos,
                            ], function ($message) use ($datos) {
                                $message->from("djramirezfr.19@gmail.com", "Billetera de Pago");
                                $message->subject("Información de Interes");
                                $message->to($datos["email"]);
                            });
                            $this->EntityResponse = ["success" => true, "cod_error" => "00", "message_success" => "Se ha enviado un correo electrónico ha ".$datos["email"]." con el id de sessión y el token para su uso al momento de confirmar el pago."];
                            return response()->json($this->EntityResponse);
                        }
                        else
                        {
                            $this->EntityResponse = ["success" => false,"cod_error" => "01", "message_error" => "Transacción Fallida, favor volver a intentar."];
                            return response()->json($this->EntityResponse);
                        }
                    }
                    else
                    {
                        $this->EntityResponse = ["success" => false,"cod_error" => "01", "message_error" => "Saldo insuficiente, su saldo es de: ".number_format($saldo,2,",",".")];
                        return response()->json($this->EntityResponse);
                    }
                }
                else
                {
                    $this->EntityResponse = ["success" => false,"cod_error" => "01", "message_error" => "Transacción Fallida, favor volver a intentar."];
                    return response()->json($this->EntityResponse);
                }
            }
            else
            {
                $this->EntityResponse = ["success" => false,"cod_error" => "01", "message_error" => "El cliente ingresado no existe, favor colocar un número de documento válido."];
                return response()->json($this->EntityResponse);
            }
        }
    }
    public function confirmarPago(Request $request)
    {
        $params = $request->only("id_session", "token");
        $validator = Validator::make($request->all(),
        [
            "id_session" => "required|integer",
            "token" => "required|string",
        ]);
        if ($validator->fails()) 
        {
            $this->EntityResponse = ["success" => false,"cod_error" => "01", "message_error" => $validator->errors()];
            return response()->json($this->EntityResponse);
        }
        else
        {
            $buscarBilleteraPago = Billeterapagos::where("id_session", "=", $params["id_session"])->where("token", "=", $params["token"])->first();
            //dd($buscarBilleteraPago);
            if (!empty($buscarBilleteraPago)) 
            {
                $id = $buscarBilleteraPago->id;
                $monto = $buscarBilleteraPago->monto;
                $documento = $buscarBilleteraPago->documento;
                $celular = $buscarBilleteraPago->celular;
                $numero_confirmacion = date("YmdHis");
                $query = Billetera::where("id", "=", $id)->where("documento", "=", $documento)->first();
                if (!empty($query)) 
                {
                    $montoTotal = $query->valor;
                    $monto_resta = $montoTotal - $monto;

                    $query->valor = $monto_resta;
                    $query->save();
                }
                $query1 = Billeterapagos::where("id_session", "=", $params["id_session"])->where("token", "=", $params["token"])->first();
                if (!empty($query1)) 
                {
                    $query1->numero_confirmacion = $numero_confirmacion;
                    $query1->save();
                    $this->EntityResponse = ["success" => true, "cod_error" => "00", "message_success" => "Su pago ha sido confirmado y este es el número de confirmación de pago: ".$query1->numero_confirmacion];
                    return response()->json($this->EntityResponse);
                }
            }
            else
            {
                $this->EntityResponse = ["success" => false,"cod_error" => "01", "message_error" => "Información incorrecta, favor colocar los datos enviado por correo."];
                return response()->json($this->EntityResponse);
            }
        }
    }
    public function consultarBilleteraSaldo(Request $request)
    {
    	$params = $request->only("documento", "celular");
        $validator = Validator::make($request->all(),
        [
            "documento" => "required|integer",
            "celular" => "required|string",
        ]);
        if ($validator->fails()) 
        {
            $this->EntityResponse = ["success" => false,"cod_error" => "01", "message_error" => $validator->errors()];
            return response()->json($this->EntityResponse);
        }
        else
        {
        	$buscarSaldo = Billetera::where("documento", "=", $params["documento"])->Where("celular", "=", $params["celular"])->first();
        	if (!empty($buscarSaldo)) 
        	{
        		$this->EntityResponse = ["success" => true, "cod_error" => "00", "message_success" => "Su saldo es ".number_format($buscarSaldo->valor,2,",",".")];
                return response()->json($this->EntityResponse);
        	}
        	else
        	{
        		$this->EntityResponse = ["success" => false,"cod_error" => "01", "message_error" => "Su datos no son correctos, colocar bien el número de documento y número de celular, favor volver a intentar."];
                return response()->json($this->EntityResponse);
        	}
        }
    }
}
?>