<?php

namespace Lift;

/**
 * Description of Human
 *
 * @author admin
 */
class Human {
    
    protected $CurFloor;
    protected $TgtFloor;
    
    CONST DEFAULT_FLOOR = 2;
    
    /**
     * init start user position
     */
    public function __construct() {
        $this->CurFloor = self::DEFAULT_FLOOR;
    }

    /**
     * Set init position for human
     * 
     * @param int $floor
     * @return \Lift\Human
     */
    public function setCurFloor($floor) {
        $this->CurFloor = $floor;
        return $this;
    }
    
    /**
     * set target floor for human
     * @param int $floor
     * @return \Lift\Human
     */
    public function setTgtFloor($floor) {
        if(is_int($floor)){
            $this->TgtFloor = $floor;
        }
        return $this;
    }
}
