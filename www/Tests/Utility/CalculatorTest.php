<?php
/**
 * Created by PhpStorm.
 * User: shooshosha
 * Date: 2016-29-06
 * Time: 12:31
 */

namespace AppBundle\Tests\Utility;

use AppBundle\Utility\Calculator;


class CalculatorTest extends 
{
    public function testAdd()
    {
        $calc = new Calculator();

        $result = $calc->add(30,12);

        $this->assertEquals(42, $result);
    }
}