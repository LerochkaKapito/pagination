<?php

/**
 * Part of the Pagination
 *
 * @author  Kilte Leichnam <nwotnbm@gmail.com>
 * @package Pagination
 */

namespace Kilte\Pagination;

/**
 * Pagination Class
 *
 * @package Kilte\Pagination
 */
class Pagination
{

    /**
     * Number of the first page
     */
    const BASE_PAGE = 1;

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
     * Create instance
     *
     * @param int $totalItems  Total items
     * @param int $currentPage Number of the current page
     * @param int $perPage     Items per page
     * @param int $neighbours  Number of neighboring pages at the left and the right sides
     *
     * @throws \LogicException
     * @return self
     */
    public function __construct($totalItems, $currentPage, $perPage, $neighbours = 4)
    {
        $this->totalItems  = (int) $totalItems;
        $this->currentPage = (int) $currentPage;
        $this->perPage     = (int) $perPage;
        $this->neighbours  = (int) $neighbours;
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
     * Returns the offset of the list's slice for the current page
     *
     * @return int
     */
    public function offset()
    {
        return $this->offset;
    }

    /**
     * Returns the limit of the list's slice for the current page
     *
     * @return int
     */
    public function limit()
    {
        return $this->perPage;
    }

    /**
     * Returns number of the current page
     *
     * @return int
     */
    public function currentPage()
    {
        return $this->currentPage;
    }

    /**
     * Display
     *
     * @return array
     */
    public function build()
    {
        if ($this->totalItems == 0 || $this->perPage == 0 || $this->totalPages == 1) {
            return array();
        }

        $output = array();

        // Previous
        $offset = $this->currentPage - 1;
        $limit  = $this->currentPage - $this->neighbours;
        $limit  = $limit < self::BASE_PAGE ? self::BASE_PAGE : $limit;
        for ($i = $offset; $i >= $limit; $i--) {
            $output[$i] = 'previous';
        }

        if ($limit - self::BASE_PAGE >= 2) {
            $output[$limit - 1] = 'less';
        }

        // First
        if ($this->currentPage - $this->neighbours > self::BASE_PAGE) {
            $output[self::BASE_PAGE] = 'first';
        }

        // Next
        $offset = $this->currentPage + 1;
        $limit  = $this->currentPage + $this->neighbours;
        $limit  = $limit > $this->totalPages ? $this->totalPages : $limit;
        for ($i = $offset; $i <= $limit; $i++) {
            $output[$i] = 'next';
        }

        if ($this->totalPages - $limit > 0) {
            $output[$limit + 1] = 'more';
        }

        // Last
        if ($this->currentPage + $this->neighbours < $this->totalPages) {
            $output[$this->totalPages] = 'last';
        }

        // Current
        $output[$this->currentPage] = 'current';

        ksort($output);

        return $output;
    }

}
