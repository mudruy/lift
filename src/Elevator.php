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
        
        $factory = new \Socket\Raw\Factory();
        $address = 'tcp://192.168.31.135:8787';
        $socket = $factory->createServer($address);
        
        $msg = "\nДобро пожаловать на  лифт сервер PHP. \n" .
                "Чтобы отключиться, наберите 'exit'. Чтобы выключить сервер, наберите 'shutdown'.\n";
        
        do {
            $stream = $socket->accept();
            $stream->write($msg);
            do {
                $buf =  $stream->read(2048, PHP_NORMAL_READ);
                
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
                $send = "PHP: Вы сказали '$buf'.\n";
                $stream->write($send);
                echo $send;
            } while (true);
            $stream->close();
        } while (true);
        $socket->close();
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
