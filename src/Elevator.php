<?php

use Lift\ElevatorBase;

namespace Lift;

/**
 * Description of Elevator
 *
 * @author admin
 */
class Elevator extends ElevatorBase{
    
    CONST MAX_FLOOR = 4;
    CONST MIN_FLOOR = 0;
    
    
    public function run() {
        sleep(1);
        die('go');
    }
    
    /**
     * set floor for lift
     * @param int $floor
     * @return \Lift\Elevator
     */
    public function ElevatorCar($floor){
        if(is_int($floor)&& self::MAX_FLOOR <= $floor && self::MIN_FLOOR >= $floor) {
            $this->CallCar[$floor] = 1;
        } else {
            throw new Exception('Try valid floor');
        }
        return $this;
    }
}
