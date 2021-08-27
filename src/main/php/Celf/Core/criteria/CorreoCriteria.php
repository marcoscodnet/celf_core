<?php
namespace Celf\Core\criteria;

use Cose\criteria\impl\Criteria;

/**
 * criteria de Correo
 *  
 * @author Marcos
 *
 */
class CorreoCriteria extends Criteria{

	private $nombre;
	
	private $email;
	
	private $activo;
	
	
	
	
	
	

	

	public function getNombre()
	{
	    return $this->nombre;
	}

	public function setNombre($nombre)
	{
	    $this->nombre = $nombre;
	}

	public function getEmail()
	{
	    return $this->email;
	}

	public function setEmail($email)
	{
	    $this->email = $email;
	}

	public function getActivo()
	{
	    return $this->activo;
	}

	public function setActivo($activo)
	{
	    $this->activo = $activo;
	}
}