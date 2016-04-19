<?php

use Lift\Elevator;
namespace Lift;


/**
 * We use Building like factory of elevators
 *
 * @author admin
 */
class Building {
    static protected $elevators = array('1' => null, '2' => null);
    static public $is_object_exist = false;
    
    
    /**
     * return instanse of Elevator
     * @return \Lift\Elevator
     */
    public static function getElevator() {
        $elevators_load = array();
        foreach (self::$elevators as $key => $value) {
            if (is_object( self::$elevators[$key]) && self::$elevators[$key] instanceof Elevator ) {
                self::$is_object_exist = true;
                //check elevator loading
                $elevators_load[$key] = self::$elevators[$key]->getCallCarCount()
                        + self::$elevators[$key]->getCallMoveCount();;
            } else {
                self::$elevators[$key] = self::createElevator($key);
                $elevators_load[$key] = 0;
            }
        }
        //search free elevator
        $min_value = min($elevators_load);
        $min_key = array_search($min_value, $elevators_load);
        return self::$elevators[$min_key];
    }

    /**
     * create elevator
     * @param string $elevator_name
     * @return \Lift\Elevator
     */
    protected static function createElevator( $elevator_name ) {
        try {
            return self::$elevators[$elevator_name] = new Elevator ();
        } catch (Exception $exc) {
            throw $exc;
        }
    }
}
