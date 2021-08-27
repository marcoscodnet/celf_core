<?php

namespace Celf\Core\model;

use Cose\model\impl\Entity;

use Cose\utils\Logger;

/**
 * Correo
 * 
 * @Entity @Table(name="celf_correo")
 * 
 * @author Marcos
 */

class Correo extends Entity{

	//variables de instancia.

	
	
	/**
	 * @Column(type="string")
	 * @var string
	 */
	private $nombre;
	
	/**
	 * @Column(type="string")
	 * @var string
	 */
	private $email;
	
	
	
	/** @Column(type="boolean") **/
	private $activo;
		
	public function __construct(){
	}
	
	public function __toString(){
		 return $this->getNombre().' - '.$this->getEmail();
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

	public function getActivo()
	{
	    return $this->activo;
	}

	public function setActivo($activo)
	{
	    $this->activo = $activo;
	}
}
?>