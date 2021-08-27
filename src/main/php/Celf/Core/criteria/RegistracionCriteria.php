<?php
namespace Celf\Core\criteria;

use Cose\criteria\impl\Criteria;

/**
 * criteria de Registracion
 *  
 * @author Marcos
 * @since 11-05-2020
 *
 */
class RegistracionCriteria extends Criteria{

	private $oidNotEqual;
	
	private $nombre;
	
	private $email;
	
	private $documento;
	
	
	private $codigoValidacion;
	

	public function getOidNotEqual()
	{
	    return $this->oidNotEqual;
	}

	public function setOidNotEqual($oidNotEqual)
	{
	    $this->oidNotEqual = $oidNotEqual;
	}

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

	

	public function getCodigoValidacion()
	{
	    return $this->codigoValidacion;
	}

	public function setCodigoValidacion($codigoValidacion)
	{
	    $this->codigoValidacion = $codigoValidacion;
	}

	public function getDocumento()
	{
	    return $this->documento;
	}

	public function setDocumento($documento)
	{
	    $this->documento = $documento;
	}
}