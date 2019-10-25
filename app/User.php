<?php

namespace App;

/**
 * Describes an user with him skills
 * 
 * @author Denys
 */
class User
{
    /**
     * List of the user's skills
     *
     * @var \SplObjectStorage
     */
    private $skills;
    
    /**
     * Constructor
     * 
     */
    public function __construct()
    {
        $this->skills = new \SplObjectStorage();
    }

    /**
     * Add new skill for user
     * 
     * @param Skill $skill
     * @return \App\User
     */
    public function addSkill(Skill $skill)
    {
        if ($this->skills->contains($skill)) {
            return $this;
        }

        $this->skills->attach($skill);
        return $this;
    }
    
    /**
     * Get a mask for user's skils
     * 
     * @return int
     */
    public function getSkillsMask():int
    {
        $mask = 0;

        foreach ($this->skills as $skill) {
            $mask |= $skill->getMask();
        }

        return $mask;
    }
}
