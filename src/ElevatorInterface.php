<?php
/**
 * Interface for use lift panel
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

/**
 * Declare how use lift by buttons
 *
 * @author admin
 */
interface ElevatorInterface
{


    /**
     * Tell elevator where is human
     *
     * @param  int $floor floor number
     * @return \Lift\Elevator
     */
    public function elevatorMove($floor);
    
    /**
     * Tell elevator in which floor human want
     *
     * @param  int $floor floor number
     * @return \Lift\Elevator
     */
    public function elevatorCar($floor);
}
