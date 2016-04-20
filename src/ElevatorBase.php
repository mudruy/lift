<?php

/**
 * Base elevator functions
 *
 * PHP version 5
 * 
 * @category Elevator
 * @package  Lift.Sample
 * @author   mudruy <mudruy@mail.ru>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/mudruy/lift
 */

namespace Lift;

use Lift\ElevatorInterface;

/**
 * Description of Elevator
 *
 * @author admin
 */
abstract class ElevatorBase implements ElevatorInterface
{

    protected $Floor;
    protected $State;
    //command from user inside lift
    protected $CallCar = array();
    //command from user outside lift
    protected $CallMove = array();
    protected $FloorTime;

    CONST FLOOR_TIME = 1;
    CONST FLOOR = 1;

    /**
   * Make lift moving
   *
   * @param  \Socket\Raw\Socket $stream Log object
   * @return void void
   */
    abstract public function run($stream);

    /**
   * Get current floor 
   *
   * @return int
   */
    public function getFloor() 
    {
        return $this->Floor;
    }

    /**
   * Init elevator speed
   */
    public function __construct() 
    {
        $this->FloorTime = self::FLOOR_TIME;
        $this->Floor = self::FLOOR;
    }

    /**
   * Get count of whish list human inside elevator
   *
   * @return int
   */
    public function getCallCarCount() 
    {
        return count($this->CallCar);
    }

    /**
   * Get count of whish list in floors
   *
   * @return int
   */
    public function getCallMoveCount() 
    {
        return count($this->CallMove);
    }

    /**
   * Set call for lift
   *
   * @param  int $floor number of floor
   * @return \Lift\Elevator
   */
    public function elevatorMove($floor) 
    {
        $floor = (int) $floor;
        if (is_numeric($floor)) {
            $this->CallMove[$floor] = 1;
        } else {
            throw new \Exception('Try valid floor');
        }
        return $this;
    }

    /**
   * Set floor for lift
   *
   * @param  int $floor floor number
   * @return \Lift\Elevator
   */
    public function elevatorCar($floor) 
    {
        $floor = (int) $floor;
        if (is_numeric($floor)) {
            $this->CallCar[$floor] = 1;
        } else {
            throw new \Exception('Try valid floor');
        }
        return $this;
    }

}
