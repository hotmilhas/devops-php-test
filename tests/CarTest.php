<?php
/**
 * Created by PhpStorm.
 * User: eugenio
 * Date: 10/10/18
 * Time: 13:25
 */

use App\Car;
use PHPUnit\Framework\TestCase;

class CarTest extends TestCase
{

    /**
     * @var $car Car
     * */
    private $car;

    public function setUp()
    {
        $this->car = new Car();
        $this->testTruncate();
    }

    public function testTruncate()
    {
        $result = $this->car->truncate();
        $this->assertTrue($result);
    }

    public function testEmpty()
    {
        $cars = [];

        $results = $this->car->all();
        $this->assertEmpty($results);

        return $cars;
    }

    public function testSave()
    {
        $input = [
            'marca' => 'Fiat',
            'modelo' => 'Palio Weekend',
            'fabricacao' => '2009'
        ];

        $result = $this->car->save((object)$input);
        $this->assertTrue($result);

        $input = [
            'marca' => 'Ford',
            'modelo' => 'Fiesta',
            'fabricacao' => '2006'
        ];

        $result = $this->car->save((object)$input);
        $this->assertTrue($result);
    }

    public function testAll()
    {

        $input = [
            'marca' => 'Fiat',
            'modelo' => 'Palio Weekend',
            'fabricacao' => '2009'
        ];
        $response = $this->car->save((object)$input);
        $this->assertTrue($response);

        $input = [
            'marca' => 'Honda',
            'modelo' => 'HRV',
            'fabricacao' => '2015'
        ];

        $response = $this->car->save((object)$input);
        $this->assertTrue($response);


        $response = $this->car->all();
        $this->assertNotEquals([], $response);
        $this->assertCount(2, $response);

        $outbound1 = [
            'id' => 1,
            'marca' => 'Fiat',
            'modelo' => 'Palio Weekend',
            'fabricacao' => '2009'
        ];

        $outbound2 = [
            'id' => 2,
            'marca' => 'Honda',
            'modelo' => 'HRV',
            'fabricacao' => '2015'
        ];

        $this->assertEquals($outbound1, $response[0]);
        $this->assertEquals($outbound2, $response[1]);
    }

}
