<?php
namespace Celf\Core\criteria;

use Cose\criteria\impl\Criteria;

/**
 * criteria de Asociado
 *  
 * @author Marcos
 * @since 11-05-2020
 *
 */
class AsociadoCriteria extends Criteria{

	private $nombre;

	private $apellido;
	
	private $nombreApellido;

	private $oidNotEqual;
	
	private $documento;
	
	
	
	private $nombreEqual;
	
	private $email;

	private $usuario;


	public function getNombre()
	{
	    return $this->nombre;
	}

	public function setNombre($nombre)
	{
	    $this->nombre = $nombre;
	}

	public function getApellido()
	{
	    return $this->apellido;
	}

	public function setApellido($apellido)
	{
	    $this->apellido = $apellido;
	}

	public function getNombreApellido()
	{
	    return $this->nombreApellido;
	}

	public function setNombreApellido($nombreApellido)
	{
	    $this->nombreApellido = $nombreApellido;
	}

	public function getOidNotEqual()
	{
	    return $this->oidNotEqual;
	}

	public function setOidNotEqual($oidNotEqual)
	{
	    $this->oidNotEqual = $oidNotEqual;
	}

	public function getDocumento()
	{
	    return $this->documento;
	}

	public function setDocumento($documento)
	{
	    $this->documento = $documento;
	}

	public function getNombreEqual()
	{
	    return $this->nombreEqual;
	}

	public function setNombreEqual($nombreEqual)
	{
	    $this->nombreEqual = $nombreEqual;
	}

	public function getEmail()
	{
	    return $this->email;
	}

	public function setEmail($email)
	{
	    $this->email = $email;
	}

	public function getUsuario()
	{
	    return $this->usuario;
	}

	public function setUsuario($usuario)
	{
	    $this->usuario = $usuario;
	}
}