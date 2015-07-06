<?php

/**
 * Part of the Pagination.
 *
 * For the full copyright and license information,
 * view the LICENSE file that was distributed with this source code.
 *
 * @author  Kilte Leichnam <nwotnbm@gmail.com>
 */
namespace Kilte\Pagination\Tests;

use Kilte\Pagination\Pagination;

/**
 * PaginationTest Class.
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
                1 => Pagination::TAG_FIRST,
                34 => Pagination::TAG_LESS,
                35 => Pagination::TAG_PREVIOUS,
                36 => Pagination::TAG_PREVIOUS,
                37 => Pagination::TAG_PREVIOUS,
                38 => Pagination::TAG_PREVIOUS,
                39 => Pagination::TAG_PREVIOUS,
                40 => Pagination::TAG_CURRENT,
                41 => Pagination::TAG_NEXT,
                42 => Pagination::TAG_NEXT,
                43 => Pagination::TAG_NEXT,
                44 => Pagination::TAG_NEXT,
                45 => Pagination::TAG_NEXT,
                46 => Pagination::TAG_MORE,
                100 => Pagination::TAG_LAST,
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

    public function testTotalPages()
    {
        $pagination = new Pagination(10, 1, 2);
        $this->assertEquals(5, $pagination->totalPages());
        $pagination = new Pagination(11, 1, 3);
        $this->assertEquals(4, $pagination->totalPages());
    }
}
