<?php

namespace Celf\Core\model;
/**
 * Categoria
 *  
 * @author Marcos
 * @since 03-05-2018
 */

class Categoria{
    
    const Residencial = 1;
    const Comercial = 2;
    const Profesional = 3;
    const Gobierno = 4;
    
    private static $items = array(  
    								   self::Residencial => "categoria.residencial.label",
    								   self::Comercial => "categoria.comercial.label",
    								   self::Profesional => "categoria.profesional.label",
    								   self::Gobierno => "categoria.gobierno.label"
    								   );
    								   
	
	public static function getItems(){
		return self::$items;
	}
	
	public static function getLabel($value){
		return self::$items[$value];
	}


}
?>
