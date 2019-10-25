<?php

namespace App;

/**
 * Describes a company requirement
 * 
 * @author Denys
 */
class Requirement
{
    /**
     * A mask of the current requirement
     * 
     * @var int
     */
    private $mask;
    
    /**
     * Constructor
     * 
     * @param int $mask
     */
    public function __construct(int $mask = null)
    {
        $this->mask = $mask?? 0;
    }
    
    /**
     * Get a requirement mask
     * 
     * @return int
     */
    public function getMask():int
    {
        return $this->mask;
    }
}
