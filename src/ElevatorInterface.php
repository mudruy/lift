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
    public function elevatorMove($floor);
    
    /**
     * tell elevator in which floor human want
     *
     * @param  int $floor
     * @return \Lift\Elevator
     */
    public function elevatorCar($floor);
}
