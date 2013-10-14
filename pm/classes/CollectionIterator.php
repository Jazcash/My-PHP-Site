<?php
class CollectionIterator implements Iterator
{
    private $_collection;
    private $_currIndex = 0;
    private $_keys;

    function __construct(Collection $coll)
    {
        $this->_collection = $coll;
        $this->_keys = $this->_collection->keys();
    }
    function rewind()
    {
        $this->_currIndex = 0;
    }
    function key()
    {
        return $this->_keys[$this->_currIndex];
    }
    function current()
    {
        return $this->_collection->getItem($this->_keys[$this->_currIndex]);
    }
    function next()
    {
        ++$this->_currIndex;
    }
    function valid()
    {
        return $this->_currIndex < $this->_collection->length();
    }
}
?>