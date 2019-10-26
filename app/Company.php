<?php

namespace App;

/**
 * Describes a company with his requirements
 * 
 * @author Denys
 */
class Company
{
    /**
     * List of a company requirements
     *
     * @var array
     */
    private $requirements;
    
    /**
     * Constructor
     * 
     */
    public function __construct()
    {
        $this->requirements = [];
    }
    
    /**
     * Add a new requirement to the company. If you want, for example, add "a flat and house", - you need add a flat requirement as a first argument and a house requirement as a second.
     * 
     * @param Requirement $mainRequiment
     * @param Requirement $additionalRequirement
     * @return \App\Company
     */
    public function addRequirement(Requirement $mainRequiment, Requirement $additionalRequirement = null):Company
    {
        if ($mainRequiment->getMask() == $additionalRequirement->getMask()) {
            $additionalRequirement = new Requirement();
        }
        $this->requirements[] = [
            $mainRequiment,
            $additionalRequirement?? new Requirement()
        ];
        
        return $this;
    }
    
    /**
     * Returns a generator for each company requirement pair
     * 
     * @return Generator
     */
    protected function requirementMasks()
    {
        foreach ($this->requirements as $cur) {
            list($main, $additional) = $cur;
            yield $main->getMask() | $additional->getMask();
        }
    }
    
    /**
     * Check ability to work given user in current company based on him skills and a company requirements
     * 
     * @param User $user
     * @return boolean
     */
    public function canWorkHere(User $user):bool
    {
        foreach ($this->requirementMasks() as $requirementMask) {
            if (($user->getSkillsMask() & $requirementMask) == $requirementMask) {
                return true;
            }
        }
        
        return false;
    }
}
