<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Pages\CommonPageElements;
use Pages\SAMSHAHomePage;
use Pages\ProgramAndCampaignsPage;
use Pages\GrantAwardsByStatePage;
/**
 * Created by PhpStorm.
 * User: sadla
 * Date: 8/21/18
 * Time: 4:33 PM
 */

class SAMHSAHomeContext extends PHPUnit_Framework_TestCase implements \Behat\Behat\Context\Context
{
    public $HomePage;
    public $GrantAwardsByStatePage;
    public $CommonPageElements;
    public $ProgramsAndCampaignsPage;

    public function __construct(SAMSHAHomePage $HomePage)
    {
        $this->HomePage = $HomePage;
    }

    /**
     * @When /^The user searches for treatment facilities with "(?P<condition>(?:[^"]|\\")*)"$/
     *
     */
    public function SearchTreatmentFacilities($condition)
    {
        $this->HomePage->type($this->HomePage->findFacilitySearchBar,$condition);
        $this->HomePage->click($this->HomePage->searchFacilityButton);
    }

    /**
     * @When /^The user is directed to treatment locator page$/
     *
     */
    public function VerifyTreatmentLocatorPage()
    {
        $windows = $this->HomePage->getWindows();
        $this->HomePage->switchWindow($windows[count($windows)-1]);
    }
    /**
     * @When /^The search list "(?P<seen>(?:[^"]|\\")*)" accordingly$/
     *
     */
    public function VerifySearchList($seen)
    {
        $listVisible = $this->HomePage->isVisible($this->HomePage->facilityList);
        if($seen == 'false'){
            $this->assertFalse($listVisible);
        }else if($seen == 'true'){
            $this->assertTrue($listVisible);
        }
    }
}

