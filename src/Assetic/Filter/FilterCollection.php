<?php

/*
 * This file is part of the Assetic package, an OpenSky project.
 *
 * (c) 2010-2014 OpenSky Project Inc
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Assetic\Filter;

use Passet\Contracts\AssetInterface;
use Passet\Contracts\FilterInterface;

/**
 * A collection of filters.
 *
 * @author Kris Wallsmith <kris.wallsmith@gmail.com>
 */
class FilterCollection implements FilterInterface, \IteratorAggregate, \Countable
{
    private $filters = array();

    public function __construct($filters = array())
    {
        foreach ($filters as $filter) {
            $this->ensure($filter);
        }
    }

    /**
     * Checks that the current collection contains the supplied filter.
     *
     * If the supplied filter is another filter collection, each of its
     * filters will be checked.
     */
    public function ensure(FilterInterface $filter)
    {
        if ($filter instanceof \Traversable) {
            foreach ($filter as $f) {
                $this->ensure($f);
            }
        } elseif (!in_array($filter, $this->filters, true)) {
            $this->filters[] = $filter;
        }
    }

    public function all()
    {
        return $this->filters;
    }

    public function clear()
    {
        $this->filters = array();
    }

    public function filterLoad(AssetInterface $asset)
    {
        foreach ($this->filters as $filter) {
            $filter->filterLoad($asset);
        }
    }

    public function filterDump(AssetInterface $asset)
    {
        foreach ($this->filters as $filter) {
            $filter->filterDump($asset);
        }
    }

    public function getIterator() : \Traversable
    {
        return new \ArrayIterator($this->filters);
    }

    public function count() : int
    {
        return count($this->filters);
    }
}
