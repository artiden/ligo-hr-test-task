<?php
error_reporting(E_ALL);
require __DIR__.'/vendor/autoload.php';

use App\User;
use App\Skill;
use App\Company;
use App\Requirement;

define('R_1', 1<<0); //apartment
define('R_2', 1<<1); //house
define('R_3', 1<<2); //property insurance
define('R_4', 1<<3); //5 door car
define('R_5', 1<<4); //4 door car
define('R_6', 1<<5); //3 door car
define('R_7', 1<<6); //2 door car
define('R_8', 1<<7); //driver's license
define('R_9', 1<<8); //car insurance
define('R_10', 1<<9); //social security number
//...

$requirements = [
    R_1,
    R_2,
    R_3,
    R_4,
    R_5,
    R_6,
    R_7,
    R_8,
    R_9,
    R_10
];

//creates an user with random skills
$user = new User();
$userSkillCount = rand(1, 3);
$added = 0;
while ($added < $userSkillCount) {
    $user->addSkill(new Skill(array_rand($requirements, 1)));
    ++$added;
}

//creates a some random companies with random requirements
$companyCount = rand(10, 10000);
$companies = [];
$created = 0;
while ($created < $companyCount) {
    $company = new Company();

    //add some requirements
    $requirementCount = rand(1, 5);
    $added = 0;
    while ($added < $requirementCount) {
        $requirementValues = array_rand($requirements, rand(1, 2));
        if (!is_array($requirementValues)) {
            $requirementValues = [$requirementValues];
        }
        $company->addRequirement(new Requirement($requirementValues[0]), new Requirement($requirementValues[1]?? null));
        ++$added;
    }
    $companies[] = $company;
    ++$created;
}

//Check and count, where an user can work :)
$totalCompany = $userWork = 0;
foreach ($companies as $company) {
    if ($company->canWorkHere($user)) {
        $userWork++;
    }
    //Can use count function on a companies array, but for consistence :)
    $totalCompany++;
}

echo sprintf('We have %d company(s), User can work in %d of them :)', $totalCompany, $userWork);
