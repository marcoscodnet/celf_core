<?php

namespace Celf\Core\model;

use Cose\model\impl\Entity;

use Cose\utils\Logger;

/**
 * 
 * Representa una persona
 * 
 * @Entity @Table(name="celf_area")

 * 
 * 
 * @author Marcos
 * @since 12-05-2020
 */
 class Area extends Entity{

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
	
	
	
	
	public function __construct(){
	}
	
	

 	public function __toString(){
		 return $this->getNombre();
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
}
?>