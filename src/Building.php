<?php

/**
 * We use Building like factory of elevators
 *
 * PHP version 5
 * 
 * @category Elevator
 * @package  Lift.Sample
 * @author   mudruy <mudruy@mail.ru>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/mudruy/lift
 */
use Lift\Elevator;

namespace Lift;

class Building
{

    static protected $elevators = array('1' => null);
    static public $is_object_exist = false;

    CONST SERVER_ADRESS = 'tcp://127.0.0.1:8787';

    /**
   * return instanse of Elevator
   *
   * @return \Lift\Elevator
   */
    public static function getElevator() 
    {
        $elevators_load = array();
        foreach (self::$elevators as $key => $value) {
            if (is_object(self::$elevators[$key]) 
                && self::$elevators[$key] instanceof Elevator
            ) {
                self::$is_object_exist = true;
                //check elevator loading
                $elevators_load[$key] = self::$elevators[$key]->getCallCarCount() 
                + self::$elevators[$key]->getCallMoveCount();
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
   * Create elevator
   *
   * @param  string $elevator_name number of lift
   * @return \Lift\Elevator
   */
    protected static function createElevator($elevator_name) 
    {
        try {
            return self::$elevators[$elevator_name] = new Elevator();
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    /**
   * run all lift in a building as server
   * implement one tread server socket
   *
   * @return void
   */
    public static function execute() 
    {

        $factory = new \Socket\Raw\Factory();
        $socket = $factory->createServer(self::SERVER_ADRESS);

        $msg = "\nДобро пожаловать на лифт сервер PHP. \n" .
            "Чтобы отключиться, наберите 'exit'. " .
            "Чтобы выключить лифт, наберите 'shutdown'.\n";

        do {
            $stream = $socket->accept();
            $stream->write($msg);

            do {
                $buf = $stream->read(2048, PHP_NORMAL_READ);

                if (!$buf = trim($buf)) {
                    continue;
                }
                if ($buf == 'exit') {
                    break;
                }
                if ($buf == 'shutdown') {
                    $stream->close();
                    break 2;
                }
                if ($buf !== '') {
                    self::upDownLift($buf, $stream);
                }

                $send = "PHP: Вы сказали '$buf'.\n";
                $stream->write($send);
                echo $send;
            } while (true);
            $stream->close();
        } while (true);
        $socket->close();
    }

    /**
   * Function for travel by up and down
     * 
   * @param  string             $buf    String from telnet
   * @param  \Socket\Raw\Socket $stream Socket for feedback
   * @return boolean
   */
    protected static function upDownLift($buf, $stream) 
    {
        $elevator = self::getElevator();
        try {
            if ($elevator->getFloor() == $buf) {
                $elevator->ElevatorCar($buf);
            } else {
                $elevator->ElevatorMove($buf);
            }
        } catch (\Exception $exc) {
            $stream->write($exc->getMessage());
        }

        $elevator->run($stream);
        return false;
    }

}
