<?php

/**
 * Part of the Pagination
 *
 * @author  Kilte Leichnam <nwotnbm@gmail.com>
 * @package Pagination
 */

namespace Kilte\Pagination\Tests;

use Kilte\Pagination\Pagination;

/**
 * PaginationTest Class
 *
 * @package Kilte\Pagination\Tests
 */
class PaginationTest extends \PHPUnit_Framework_TestCase
{

    public function testOffset()
    {
        $pagination = new Pagination(10, 2, 5);
        $this->assertEquals(5, $pagination->offset());
    }

    public function testLimit()
    {
        $pagination = new Pagination(20, 1, 10);
        $this->assertEquals(10, $pagination->limit());
    }

    public function testCurrentPage()
    {
        $pagination = new Pagination(20, 2, 10);
        $this->assertEquals(2, $pagination->currentPage());
    }

    public function testBuild()
    {
        $pagination = new Pagination(1000, 40, 10, 5);
        $this->assertEquals(
            array(
                1   => 1,
                34  => '...',
                35  => 35,
                36  => 36,
                37  => 37,
                38  => 38,
                39  => 39,
                40  => false,
                41  => 41,
                42  => 42,
                43  => 43,
                44  => 44,
                45  => 45,
                46  => '...',
                100 => 100,
            ),
            $pagination->build()
        );
        $pagination = new Pagination(0, 1, 10);
        $this->assertEquals(array(), $pagination->build());
        $pagination = new Pagination(10, 1, 10);
        $this->assertEquals(array(), $pagination->build());
        $pagination = new Pagination(10, 0, 20);
        $this->assertEquals(array(), $pagination->build());
    }

    public function testConstructorPerPageException()
    {
        $this->setExpectedException('\LogicException');
        new Pagination(0, 0, -1);
    }

    public function testConstructorNeighboursException()
    {
        $this->setExpectedException('\LogicException');
        new Pagination(0, 0, 1, -1);
    }

}
