<?php 
namespace App\Wsgeneric\Model;


class EntityResponse
{
    /**
    Propiedad que codigo de la  respuesta del Servicio 
    */   
    var $codResponse;
    
    /**
    Propiedad que mensaje de la  respuesta del Servicio 
    */  
    
    var $messageResponse;
    
    /**
    Propiedad que indica el nombre de la entidad que esta retornando el Servicio
    */   
    var $entityResponse;
	
	/**
		* Propiedad que indica la cantidad de filas afectadas en el Servicio
		* Modificado por Diony Reveron 
		* 28-06-2016
    */   
    var $filasAfectadas;
	
	/**
		* Propiedad que indica las filas no afectadas en el Servicio
		* Modificado por Diony Reveron 
		* 19-07-2016
    */   
    var $filasNoAfectadas;
}