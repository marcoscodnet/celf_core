<?php
namespace Celf\Core\criteria;

use Cose\criteria\impl\Criteria;

/**
 * criteria de EstadoReclamo
 *  
 * @author Marcos
 * @since 14-05-2020
 *
 */
class EstadoReclamoCriteria extends Criteria{

	private $nombre;


	private $orden;

	


	

	

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