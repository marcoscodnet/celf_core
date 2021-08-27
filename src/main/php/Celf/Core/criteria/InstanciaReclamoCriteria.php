<?php
namespace Celf\Core\criteria;

use Cose\criteria\impl\Criteria;

/**
 * criteria de gasto
 *  
 *  @author Marcos
 * @since 14-05-2020
 *
 */
class InstanciaReclamoCriteria extends Criteria{

	private $desde;

	private $desdeDesde;
	
	private $desdeHasta;
	
	private $hasta;

	private $hastaDesde;
	
	private $hastaHasta;

	private $reclamo;
	
	private $usuario;
	
	private $estadoNotEqual;
	
	private $estadoReclamo;

	private $estadosIn;

	private $estadosNotIn;
	
	private $hastaNull;
	
	
	

	

	public function getDesde()
	{
	    return $this->desde;
	}

	public function setDesde($desde)
	{
	    $this->desde = $desde;
	}

	public function getDesdeDesde()
	{
	    return $this->desdeDesde;
	}

	public function setDesdeDesde($desdeDesde)
	{
	    $this->desdeDesde = $desdeDesde;
	}

	public function getDesdeHasta()
	{
	    return $this->desdeHasta;
	}

	public function setDesdeHasta($desdeHasta)
	{
	    $this->desdeHasta = $desdeHasta;
	}

	public function getHasta()
	{
	    return $this->hasta;
	}

	public function setHasta($hasta)
	{
	    $this->hasta = $hasta;
	}

	public function getHastaDesde()
	{
	    return $this->hastaDesde;
	}

	public function setHastaDesde($hastaDesde)
	{
	    $this->hastaDesde = $hastaDesde;
	}

	public function getHastaHasta()
	{
	    return $this->hastaHasta;
	}

	public function setHastaHasta($hastaHasta)
	{
	    $this->hastaHasta = $hastaHasta;
	}

	public function getReclamo()
	{
	    return $this->reclamo;
	}

	public function setReclamo($reclamo)
	{
	    $this->reclamo = $reclamo;
	}

	public function getUsuario()
	{
	    return $this->usuario;
	}

	public function setUsuario($usuario)
	{
	    $this->usuario = $usuario;
	}

	public function getEstadoNotEqual()
	{
	    return $this->estadoNotEqual;
	}

	public function setEstadoNotEqual($estadoNotEqual)
	{
	    $this->estadoNotEqual = $estadoNotEqual;
	}

	

	public function getEstadosIn()
	{
	    return $this->estadosIn;
	}

	public function setEstadosIn($estadosIn)
	{
	    $this->estadosIn = $estadosIn;
	}

	public function getEstadosNotIn()
	{
	    return $this->estadosNotIn;
	}

	public function setEstadosNotIn($estadosNotIn)
	{
	    $this->estadosNotIn = $estadosNotIn;
	}

	public function getHastaNull()
	{
	    return $this->hastaNull;
	}

	public function setHastaNull($hastaNull)
	{
	    $this->hastaNull = $hastaNull;
	}

    public function getEstadoReclamo()
    {
        return $this->estadoReclamo;
    }

    public function setEstadoReclamo($estadoReclamo)
    {
        $this->estadoReclamo = $estadoReclamo;
    }
}