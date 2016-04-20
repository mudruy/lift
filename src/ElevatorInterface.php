<?php

namespace Lift;

/**
 * declare how use lift by buttons
 *
 * @author admin
 */
interface ElevatorInterface
{


    /**
     * tell elevator where is human
     *
     * @param  int $floor
     * @return \Lift\Elevator
     */
    public function ElevatorMove($floor);
    
    /**
     * tell elevator in which floor human want
     *
     * @param  int $floor
     * @return \Lift\Elevator
     */
    public function ElevatorCar($floor);
}
