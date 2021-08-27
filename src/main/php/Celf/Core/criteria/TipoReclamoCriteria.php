<?php
namespace Celf\Core\criteria;

use Cose\criteria\impl\Criteria;

/**
 * criteria de TipoReclamo
 *  
 * @author Marcos
 * @since 12-05-2020
 *
 */
class TipoReclamoCriteria extends Criteria{

	private $nombre;


	private $area;

	


	

	

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