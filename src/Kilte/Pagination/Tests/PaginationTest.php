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
                1   => 'first',
                34  => 'less',
                35  => 'previous',
                36  => 'previous',
                37  => 'previous',
                38  => 'previous',
                39  => 'previous',
                40  => 'current',
                41  => 'next',
                42  => 'next',
                43  => 'next',
                44  => 'next',
                45  => 'next',
                46  => 'more',
                100 => 'last',
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
