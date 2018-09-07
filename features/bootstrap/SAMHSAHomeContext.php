<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Pages\AboutUsPage;
use Pages\SAMSHAHomePage;

/**
 * Created by PhpStorm.
 * User: sadla
 * Date: 8/21/18
 * Time: 4:33 PM
 */

class SAMHSAHomeContext extends PHPUnit_Framework_TestCase implements \Behat\Behat\Context\Context
{
    public $HomePage;
    public $AboutUsPage;

    public function __construct(SAMSHAHomePage $HomePage,AboutUsPage $aboutUsPage)
    {
        $this->HomePage = $HomePage;
        $this->AboutUsPage = $aboutUsPage;
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
        $this->HomePage->waitForTime(2000);
        $listVisible = $this->HomePage->isVisible($this->HomePage->facilityList);
        if($seen == 'false'){
            $this->assertFalse($listVisible);
        }else if($seen == 'true'){
            $this->assertTrue($listVisible);
        }
    }

    /**
     * @Given /^The user sees there is a map frame pointing to SAMHSA address$/
     */
    public function IsMapQuestVisible()
    {
        $this->AboutUsPage->executeScript("document.getElementsByTagName('iframe')[1].setAttribute('id','pinFrame');");
        $this->AboutUsPage->switchIFrame('pinFrame');
        $framevisible = $this->AboutUsPage->isVisible($this->AboutUsPage->mapQuestWindow);
        $this->assertTrue($framevisible,'Map is not visible');
        $this->AboutUsPage->switchIFrame();
    }
    /**
     * @Given /^The user hover over main menu for "(?P<option>(?:[^"]|\\")*)"$/
     */
    public function HoverOverMainMenuOption($option)
    {
        $this->HomePage->hoverOver($this->HomePage->mainMenuOption($option));
        $this->HomePage->waitForTime(1000);
    }
    /**
     * @Given /^Treatment help line for "(?P<option>(?:[^"]|\\")*)" is seen$/
     */
    public function TreatmentMenuOptionsVisible($option)
    {
//        $this->HomePage->waitForTime(8000);
        $imgvisible = $this->HomePage->isVisible($this->HomePage->treatmentMenuOptionsImages($option));
       $this->assertTrue($imgvisible);
       if($option=='National Suicide Prevention Lifeline'){
           $text = $this->HomePage->getText($this->HomePage->treatmentMenuOptionsPhoneNumbers().'[contains(text(),"1-800-273-8255 (TALK)")]');
           $this->assertContains('TTY: 1-800-799-4889',$text);
       } elseif($option=='National Helpline'){
            $text = $this->HomePage->getText($this->HomePage->treatmentMenuOptionsPhoneNumbers().'[contains(text(),"1-800-662-4357 (HELP)")]');
            $this->assertContains('TTY: 1-800-487-4889',$text);
       } elseif($option=='Disaster Distress Helpline'){
           $text = $this->HomePage->getText($this->HomePage->treatmentMenuOptionsPhoneNumbers().'[contains(text(),"1-800-985-5990")]');
           $this->assertContains('TTY: 1-800-846-8517',$text);
       }
    }
    /**
     * @Given /^Grant option "(?P<option>(?:[^"]|\\")*)" is seen$/
     */
    public function GrantMenuOptionsVisible($option)
    {
        $optionVisible = $this->HomePage->isVisible($this->HomePage->grantMenuOptions($option));
        $this->assertTrue($optionVisible);
    }
    /**
     * @Given /^Programs & Campaign option "(?P<option>(?:[^"]|\\")*)" is seen$/
     */
    public function ProgramsAndCampaignMenuOptionsVisible($option)
    {
        if($option=='Popular Programs, Campaigns, & Initiatives'){
            $optionVisible = $this->HomePage->isVisible('.//div[@qtip]//div[@class="mega-header"]/a[contains(text(),"Popular Programs, Campaigns,")]');
            $this->assertTrue($optionVisible);
        }else{
            $optionVisible = $this->HomePage->isVisible($this->HomePage->programsAndCampaignsMenuOptions($option));
            $this->assertTrue($optionVisible);
        }

    }
    /**
     * @Given /^About Us option "(?P<option>(?:[^"]|\\")*)" is seen$/
     */
    public function AboutMenuOptionsVisible($option)
    {
        $optionVisible = $this->HomePage->isVisible($this->HomePage->aboutUsMenuOptions($option));
        $this->assertTrue($optionVisible);
    }

}

