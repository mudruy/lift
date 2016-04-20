<?php

/**
 * Test for BuildingTest
 *
 * PHP version 5
 * 
 * @category Test
 * @package  Lift.Test
 * @author   mudruy <mudruy@mail.ru>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/mudruy/lift
 */
use \Lift\Building;

class BuildingTest extends PHPUnit_Framework_TestCase
{

    /**
   * @inheritdoc
   */
    public static function setUpBeforeClass() 
    {
        parent::setUpBeforeClass();
        $cmd = "nohup php run.php &>/dev/null &";
        shell_exec($cmd);
    }

    /**
   * Test creation for lift
   */
    public function testCreationSingleton() 
    {
        $elevator = Building::getElevator();
        $this->assertFalse(Building::$is_object_exist);

        $elevator = Building::getElevator();
        $this->assertTrue(Building::$is_object_exist);
    }

    /**
   * Functional test for lift call
   */
    public function testServerExecuteUp() 
    {

        sleep(1);
        $factory = new \Socket\Raw\Factory();
        $socket = $factory->createClient('tcp://127.0.0.1:8787');

        $buf = $socket->read(8192, PHP_NORMAL_READ);
        // send simple HTTP request to remote side
        $socket->write("3\r\n");

        do {
            try {
                $buf .= $socket->read(8192, PHP_NORMAL_READ);
                if (strpos($buf, "PHP: Вы сказали '3'")) {
                    $socket->write("exit\r\n");
                }
            } catch (Exception $exc) {
                break;
            }
        } while (true);
        $socket->close();
        $this->assertContains('Лифт прибыл на ваш этаж 3', $buf, 'Lift do not go up');
    }

    /**
   * Functional test for lift call down
   */
    public function testServerExecuteDown() 
    {
        $factory = new \Socket\Raw\Factory();
        $socket = $factory->createClient('tcp://127.0.0.1:8787');

        $buf = $socket->read(8192, PHP_NORMAL_READ);
        // send simple HTTP request to remote side
        $socket->write("1\r\n");

        do {
            try {
                $buf .= $socket->read(8192, PHP_NORMAL_READ);
                if (strpos($buf, "PHP: Вы сказали '1'")) {
                    $socket->write("exit\r\n");
                }
            } catch (Exception $exc) {
                break;
            }
        } while (true);
        $socket->close();
        $this->assertContains('Лифт прибыл на ваш этаж 1', $buf, 'Lift do not go down');
    }

    /**
   * Functional test up and down whith human
   */
    public function testServerExecuteUpDownWhithHuman() 
    {
        $factory = new \Socket\Raw\Factory();
        $socket = $factory->createClient('tcp://127.0.0.1:8787');

        $buf = $socket->read(8192, PHP_NORMAL_READ);
        // send simple HTTP request to remote side
        $socket->write("1\r\n");
        $socket->write("5\r\n");
        $socket->write("4\r\n");

        do {
            try {
                $buf .= $socket->read(8192, PHP_NORMAL_READ);
                if (strpos($buf, "PHP: Вы сказали '4'")) {
                    $socket->write("exit\r\n");
                }
            } catch (Exception $exc) {
                break;
            }
        } while (true);
        $socket->close();
        $this->assertContains('Лифт прибыл на ваш этаж 5', $buf, 'Lift do not move whith human to 5 floor');
        $this->assertContains('Лифт прибыл на ваш этаж 4', $buf, 'Lift do not move whith human to 4 floor');
    }

    /**
   * @inheritdoc
   */
    public static function tearDownAfterClass() 
    {
        parent::tearDownAfterClass();
        $factory = new \Socket\Raw\Factory();
        $socket = $factory->createClient('tcp://127.0.0.1:8787');
        $socket->write("shutdown\r\n");
        $socket->close();
    }

}
