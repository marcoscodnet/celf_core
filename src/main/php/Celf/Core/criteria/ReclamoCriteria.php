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
class ReclamoCriteria extends Criteria{

	private $fecha;

	private $fechaDesde;
	
	private $fechaHasta;

	private $tipoReclamo;
	
	private $usuario;
	
	private $estadoNotEqual;
	
	private $estado;

	private $estadosIn;

	private $estadosNotIn;
	
	
	

	public function getFecha()
	{
	    return $this->fecha;
	}

	public function setFecha($fecha)
	{
	    $this->fecha = $fecha;
	}

	public function getFechaDesde()
	{
	    return $this->fechaDesde;
	}

	public function setFechaDesde($fechaDesde)
	{
	    $this->fechaDesde = $fechaDesde;
	}

	public function getFechaHasta()
	{
	    return $this->fechaHasta;
	}

	public function setFechaHasta($fechaHasta)
	{
	    $this->fechaHasta = $fechaHasta;
	}

	public function getTipoReclamo()
	{
	    return $this->tipoReclamo;
	}

	public function setTipoReclamo($tipoReclamo)
	{
	    $this->tipoReclamo = $tipoReclamo;
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

	public function getEstado()
	{
	    return $this->estado;
	}

	public function setEstado($estado)
	{
	    $this->estado = $estado;
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
}