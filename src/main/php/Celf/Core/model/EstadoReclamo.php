<?php

namespace Celf\Core\model;

use Cose\model\impl\Entity;

use Cose\utils\Logger;

/**
 * 
 * Representa una persona
 * 
 * @Entity @Table(name="celf_estado_reclamo")

 * 
 * 
 * @author Marcos
 * @since 14-05-2020
 */
 class EstadoReclamo extends Entity{

	//variables de instancia.

	
	/**
	 * @Column(type="string")
	 * @var string
	 */
	private $nombre;
	

	 /**
     * @var int|null
     *
     * @Column(type="integer", nullable=true)
     */
    private $orden;
	
	
	
	
	
	
	
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



	public function getOrden()
	{
	    return $this->orden;
	}

	public function setOrden($orden)
	{
	    $this->orden = $orden;
	}
}
?>