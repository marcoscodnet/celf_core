<?php

namespace Celf\Core\model;

use Cose\model\impl\Entity;

use Cose\utils\Logger;

/**
 * 
 * Representa una persona
 * 
 * @Entity @Table(name="celf_tipo_reclamo")

 * 
 * 
 * @author Marcos
 * @since 12-05-2020
 */
 class TipoReclamo extends Entity{

	//variables de instancia.

	
	/**
	 * @Column(type="string")
	 * @var string
	 */
	private $nombre;
	

	
	
	
	/**
     * @ManyToOne(targetEntity="Area",cascade={"merge"})
     * @JoinColumn(name="area_oid", referencedColumnName="oid")
     * @var ConceptoGasto
     **/
	private $area;
	
	
	
	
	public function __construct(){
	}
	
	
 	public function __toString(){
		 return $this->getArea().' - '.$this->getNombre();
	}


	public function getNombre()
	{
	    return $this->nombre;
	}

	public function setNombre($nombre)
	{
	    $this->nombre = $nombre;
	}

	public function getArea()
	{
	    return $this->area;
	}

	public function setArea($area)
	{
	    $this->area = $area;
	}
}
?>