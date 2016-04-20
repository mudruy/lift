<?php

/**
 * Test for ElevatorTest
 *
 * PHP version 5
 * 
 * @category Test
 * @package  Lift.Test
 * @author   mudruy <mudruy@mail.ru>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/mudruy/lift
 */
use Lift\Elevator;

class ElevatorTest extends PHPUnit_Framework_TestCase
{

    /**
   * Test setter from interface mor call vector
   */
    public function testElevatorCar() 
    {
        $elevator = new Elevator();
        $elevator->elevatorCar(3);
        $this->assertEquals(1, $elevator->getCallCarCount());
    }

    /**
   * Test setter from interface mor move vector
   */
    public function testElevatorMove() 
    {
        $elevator = new Elevator();
        $elevator->elevatorMove(5);
        $this->assertEquals(1, $elevator->getCallMoveCount());
    }

    /**
   * @expectedException     Exception
   * @expectedExceptionMessage Try valid floor
   */
    public function testExceptionElevatorMove() 
    {
        $elevator = new Elevator();
        $elevator->elevatorMove(6);
        $elevator->elevatorMove(-1);
        $elevator->elevatorMove('Hello');
    }
    
    /**
   * @expectedException     Exception
   * @expectedExceptionMessage Try valid floor
   */
    public function testExceptionElevatorMoveDown() 
    {
        $elevator = new Elevator();
        $elevator->elevatorMove(-1);
    }
    
    /**
   * @expectedException     Exception
   * @expectedExceptionMessage Try valid floor
   */
    public function testExceptionElevatorMoveWord() 
    {
        $elevator = new Elevator();
        $elevator->elevatorMove('Hello');
    }

}
