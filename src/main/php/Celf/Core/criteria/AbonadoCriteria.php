<?php
namespace Celf\Core\criteria;

use Cose\criteria\impl\Criteria;

/**
 * criteria de Abonado
 *  
 * @author Marcos
 *
 */
class AbonadoCriteria extends Criteria{

	private $apellido;
	
	private $nombre;
	
	private $calle;
	
	private $categoria;
	
	private $telefono;
	
	private $categorias;
	
	private $categoriaNotEqual;
	
	
	
	

	public function getApellido()
	{
	    return $this->apellido;
	}

	public function setApellido($apellido)
	{
	    $this->apellido = $apellido;
	}

	public function getCategoria()
	{
	    return $this->categoria;
	}

	public function setCategoria($categoria)
	{
	    $this->categoria = $categoria;
	}

	public function getTelefono()
	{
	    return $this->telefono;
	}

	public function setTelefono($telefono)
	{
	    $this->telefono = $telefono;
	}

	public function getCategorias()
	{
	    return $this->categorias;
	}

	public function setCategorias($categorias)
	{
	    $this->categorias = $categorias;
	}

	public function getCategoriaNotEqual()
	{
	    return $this->categoriaNotEqual;
	}

	public function setCategoriaNotEqual($categoriaNotEqual)
	{
	    $this->categoriaNotEqual = $categoriaNotEqual;
	}

	public function getNombre()
	{
	    return $this->nombre;
	}

	public function setNombre($nombre)
	{
	    $this->nombre = $nombre;
	}

	public function getCalle()
	{
	    return $this->calle;
	}

	public function setCalle($calle)
	{
	    $this->calle = $calle;
	}
}