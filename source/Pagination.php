<?php

/**
 * Part of the Pagination.
 *
 * For the full copyright and license information,
 * view the LICENSE file that was distributed with this source code.
 *
 * @author  Kilte Leichnam <nwotnbm@gmail.com>
 */
namespace Kilte\Pagination;

/**
 * Pagination Class.
 */
class Pagination
{
    /**
     * Number of the first page.
     */
    const BASE_PAGE = 1;

    /**
     * First page.
     */
    const TAG_FIRST = 'first';

    /**
     * The page before the previous neighbour pages.
     */
    const TAG_LESS = 'less';

    /**
     * Previous pages.
     */
    const TAG_PREVIOUS = 'previous';

    /**
     * Current page.
     */
    const TAG_CURRENT = 'current';

    /**
     * Next pages.
     */
    const TAG_NEXT = 'next';

    /**
     * The page after the next neighbour pages.
     */
    const TAG_MORE = 'more';

    /**
     * Last page.
     */
    const TAG_LAST = 'last';

    /**
     * @var int Total Items
     */
    private $totalItems;

    /**
     * @var int Number of the current page
     */
    private $currentPage;

    /**
     * @var int Items per page
     */
    private $perPage;

    /**
     * @var int Total pages
     */
    private $totalPages;

    /**
     * @var int Offset
     */
    private $offset;

    /**
     * @var int Number of neighboring pages at the left and the right sides
     */
    private $neighbours;

    /**
     * Create instance.
     *
     * @param int $totalItems  Total items
     * @param int $currentPage Number of the current page
     * @param int $perPage     Items per page
     * @param int $neighbours  Number of neighboring pages at the left and the right sides
     *
     * @throws \LogicException
     *
     * @return self
     */
    public function __construct($totalItems, $currentPage, $perPage, $neighbours = 4)
    {
        $this->totalItems = (int) $totalItems;
        $this->currentPage = (int) $currentPage;
        $this->perPage = (int) $perPage;
        $this->neighbours = (int) $neighbours;
        if ($this->perPage <= 0) {
            throw new \LogicException('Items per page must be at least 1');
        }
        if ($this->neighbours <= 0) {
            throw new \LogicException('Number of neighboring pages must be at least 1');
        }
        if ($this->currentPage < self::BASE_PAGE) {
            $this->currentPage = self::BASE_PAGE;
        }
        $this->totalPages = (int) ceil($this->totalItems / $this->perPage);
        if ($this->currentPage > $this->totalPages) {
            $this->currentPage = $this->totalPages;
        }
        $this->offset = abs(intval($this->currentPage * $this->perPage - $this->perPage));
    }

    /**
     * Returns the offset of the list's slice for the current page.
     *
     * @return int
     */
    public function offset()
    {
        return $this->offset;
    }

    /**
     * Returns the limit of the list's slice for the current page.
     *
     * @return int
     */
    public function limit()
    {
        return $this->perPage;
    }

    /**
     * Returns number of the current page.
     *
     * @return int
     */
    public function currentPage()
    {
        return $this->currentPage;
    }

    /**
     * Returns number of the last page.
     *
     * @return int
     */
    public function totalPages()
    {
        return $this->totalPages;
    }

    /**
     * Display.
     *
     * @return array
     */
    public function build()
    {
        if ($this->totalItems == 0 || $this->totalPages == 1) {
            return array();
        }

        $output = array();

        // Previous
        $offset = $this->currentPage - 1;
        $limit = $this->currentPage - $this->neighbours;
        $limit = $limit < self::BASE_PAGE ? self::BASE_PAGE : $limit;
        for ($i = $offset; $i >= $limit; $i--) {
            $output[$i] = self::TAG_PREVIOUS;
        }

        if ($limit - self::BASE_PAGE >= 2) {
            $output[$limit - 1] = self::TAG_LESS;
        }

        // First
        if ($this->currentPage - $this->neighbours > self::BASE_PAGE) {
            $output[self::BASE_PAGE] = self::TAG_FIRST;
        }

        // Next
        $offset = $this->currentPage + 1;
        $limit = $this->currentPage + $this->neighbours;
        $limit = $limit > $this->totalPages ? $this->totalPages : $limit;
        for ($i = $offset; $i <= $limit; $i++) {
            $output[$i] = self::TAG_NEXT;
        }

        if ($this->totalPages - $limit > 0) {
            $output[$limit + 1] = self::TAG_MORE;
        }

        // Last
        if ($this->currentPage + $this->neighbours < $this->totalPages) {
            $output[$this->totalPages] = self::TAG_LAST;
        }

        // Current
        $output[$this->currentPage] = self::TAG_CURRENT;

        ksort($output);

        return $output;
    }
}
