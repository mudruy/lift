<?php
/**
 * Implement elevator moving
 *
 * PHP version 5
 * 
 * @category Elevator
 * @package  Lift.Sample
 * @author   mudruy <mudruy@mail.ru>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/mudruy/lift
 */
use Lift\ElevatorBase;

namespace Lift;

/**
 * Description of Elevator
 *
 * @author admin
 */
class Elevator extends ElevatorBase
{

    CONST MAX_FLOOR = 5;
    CONST MIN_FLOOR = 1;

    /**
   * 
   * @param  \Socket\Raw\Socket $stream socket for feedback
     * @return void void
   */
    public function run($stream) 
    {
        $lift_mess = 'Лифт находиться на этаже ';
        $lift_y_floor_mess = 'Лифт находиться на вашем этаже ';
        //if exist humane inside lift 
        if (count($this->CallCar) > 0) {
            foreach ($this->CallCar as $key => $value) {
                if ($value == 1) {
                    $next_stage = $key;
                    break;
                }
            }
            if ($next_stage == $this->Floor) {
                $stream->write($lift_y_floor_mess . $this->Floor . "\n");
                unset($this->CallCar[$next_stage]);
                return;
            }
            if ($this->Floor < $next_stage) {
                for ($i = $this->Floor; $i <= $next_stage; $i++) {
                    sleep($this->FloorTime);
                    $stream->write($lift_mess . $i . "\n");
                }
            } else {
                for ($i = $this->Floor; $i >= $next_stage; $i--) {
                    sleep($this->FloorTime);
                    $stream->write($lift_mess . $i . "\n");
                }
            }
            $this->Floor = $next_stage;
            unset($this->CallCar[$next_stage]);

            $stream->write('Лифт прибыл на ваш этаж' . $next_stage . "\n");
        } else {
            //if lift empty
            if (count($this->CallMove) > 0) {
                foreach ($this->CallMove as $key => $value) {
                    if ($value == 1) {
                        $next_stage = $key;
                        break;
                    }
                }
                if ($next_stage == $this->Floor) {
                    $stream->write($lift_y_floor_mess . $this->Floor . "\n");
                    unset($this->CallMove[$next_stage]);
                    return;
                }
                if ($this->Floor < $next_stage) {
                    for ($i = $this->Floor; $i <= $next_stage; $i++) {
                        sleep($this->FloorTime);
                        $stream->write($lift_mess . $i . "\n");
                    }
                } else {
                    for ($i = $this->Floor; $i >= $next_stage; $i--) {
                        sleep($this->FloorTime);
                        $stream->write($lift_mess . $i . "\n");
                    }
                }
                $this->Floor = $next_stage;
                unset($this->CallMove[$next_stage]);

                $stream->write('Лифт прибыл на ваш этаж' . $next_stage . "\n");
            }
        }
    }

    /**
   * set floor for lift
   *
   * @param  int $floor floor number
   * @return \Lift\Elevator
   */
    public function elevatorCar($floor) 
    {
        $floor = (int) $floor;
        if (is_numeric($floor) && self::MAX_FLOOR >= $floor 
            && self::MIN_FLOOR <= $floor
        ) {
            $this->CallCar[$floor] = 1;
        } else {
            throw new \Exception("Try valid floor\n");
        }
        return $this;
    }

    /**
   * set floor for call
   *
   * @param  int $floor floor number
   * @return \Lift\Elevator
   */
    public function elevatorMove($floor) 
    {
        $floor = (int) $floor;
        if (is_numeric($floor) && self::MAX_FLOOR >= $floor 
            && self::MIN_FLOOR <= $floor
        ) {
            $this->CallMove[$floor] = 1;
        } else {
            throw new \Exception("Try valid floor\n");
        }
        return $this;
    }

}
