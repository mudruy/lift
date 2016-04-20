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
    CONST FLOOR      = 1;
    
    /**
     * make lift moving
     *
     * @param \Socket\Raw\Socket $stream
     */
    abstract public function run($stream);

    /**
     * get current floor 
     *
     * @return int
     */
    public function getFloor()
    {
        return $this->Floor;
    }

    /**
     * init elevator speed
     */
    public function __construct() 
    {
        $this->FloorTime = self::FLOOR_TIME;
        $this->Floor = self::FLOOR;
    }
    
    
    /**
     * get count of whish list human inside elevator
     *
     * @return int
     */
    public function getCallCarCount()
    {
        return count($this->CallCar);
    }
    
    /**
     * get count of whish list in floors
     *
     * @return int
     */
    public function getCallMoveCount()
    {
        return count($this->CallMove);
    }
    
    /**
     * set call for lift
     *
     * @param  int $floor
     * @return \Lift\Elevator
     */
    public function ElevatorMove($floor)
    {
        $floor = (int)$floor;
        if(is_numeric($floor)) {
            $this->CallMove[$floor] = 1;
        } else {
            throw new \Exception('Try valid floor');
        }
        return $this;
    }
    
    /**
     * set floor for lift
     *
     * @param  int $floor
     * @return \Lift\Elevator
     */
    public function ElevatorCar($floor)
    {
        $floor = (int)$floor;
        if(is_numeric($floor)) {
            $this->CallCar[$floor] = 1;
        } else {
            throw new \Exception('Try valid floor');
        }
        return $this;
    }
    
}
