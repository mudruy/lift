<?php

namespace Lift;
use Lift\ElevatorInterface;

/**
 * Description of Elevator
 *
 * @author admin
 */
abstract class ElevatorBase implements ElevatorInterface {
    protected $Floor;
    protected $State;
    //command from user inside lift
    protected $CallCar = array();
    //command from user outside lift
    protected $CallMove = array();
    protected $FloorTime;


    CONST STATE_UP = 'GoingUp';
    CONST STATE_DOWN = 'GoingDown';
    CONST STATE_NEUTRAL = 'Neutral';
    
    CONST FLOOR_TIME = 1;
    
    abstract public function run();

        /**
     * init elevator speed
     */
    public function __construct() {
        $this->FloorTime = self::FLOOR_TIME;
    }
    
    
    /**
     * get count of whish list human inside elevator
     * @return int
     */
    public function getCallCarCount(){
        return count($this->CallCar);
    }
    
    /**
     * get count of whish list in floors
     * @return int
     */
    public function getCallMoveCount(){
        return count($this->CallMove);
    }
    
    /**
     * set call for lift
     * @param int $floor
     * @return \Lift\Elevator
     */
    public function ElevatorMove($floor){
        $this->CallMove[$floor] = 1;
        return $this;
    }
    
    /**
     * set floor for lift
     * @param int $floor
     * @return \Lift\Elevator
     */
    public function ElevatorCar($floor){
        if(is_int($floor)) {
            $this->CallCar[$floor] = 1;
        } else {
            throw new Exception('Try valid floor');
        }
        return $this;
    }
    
}
