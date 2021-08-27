<?php
namespace Celf\Core\criteria;

use Cose\criteria\impl\Criteria;

/**
 * criteria de Area
 *  
 * @author Marcos
 * @since 12-05-2020
 *
 */
class AreaCriteria extends Criteria{

	private $nombre;


	private $email;

	


	

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
}