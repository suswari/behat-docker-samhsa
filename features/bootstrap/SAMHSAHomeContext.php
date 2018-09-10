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
     * @Given /^All valid Treatment helpline images and phone numbers are seen$/
     */
    public function TreatmentMenuOptionsVisible()
    {
        $categories = array('National Suicide Prevention Lifeline','National Helpline','Disaster Distress Helpline');
        foreach($categories as $option){
            $imgvisible = $this->HomePage->isVisible($this->HomePage->treatmentMenuOptionsImages($option));
            $this->assertTrue($imgvisible,'Image for '.$option.' is not visible');
            if($option=='National Suicide Prevention Lifeline'){
                $text = $this->HomePage->getFieldText($this->HomePage->treatmentMenuOptionsPhoneNumbers().'[contains(text(),"1-800-273-8255 (TALK)")]');
                $this->assertContains('TTY: 1-800-799-4889',$text,'phone number for '.$option.' is not seen');
            } elseif($option=='National Helpline'){
                $text = $this->HomePage->getFieldText($this->HomePage->treatmentMenuOptionsPhoneNumbers().'[contains(text(),"1-800-662-4357 (HELP)")]');
                $this->assertContains('TTY: 1-800-487-4889',$text,'phone number for '.$option.' is not seen');
            } elseif($option=='Disaster Distress Helpline'){
                $text = $this->HomePage->getFieldText($this->HomePage->treatmentMenuOptionsPhoneNumbers().'[contains(text(),"1-800-985-5990")]');
                $this->assertContains('TTY: 1-800-846-8517',$text,'phone number for '.$option.' is not seen');
            }
        }
        $links = array('Treatment Locators','Behavioral Health Treatment Services Locators','Buprenorphine Physician & Treatment Program Locator','Opioid Treatment Program Directory','View All Helplines and Treatment Locators');
        foreach($links as $option){
            $linkvisible = $this->HomePage->isVisible($this->HomePage->treatmentMenuOptionsLinks($option));
            $this->assertTrue($linkvisible,'Link - '.$option.' is not visible');
        }

    }
    /**
     * @Given /^Category for Grant, "(?P<option>(?:[^"]|\\")*)" is seen$/
     *  @Given /^All valid Grant categories are seen$/
     */
    public function GrantMenuOptionsVisible()
    {
        $categories = array('Fiscal Year 2018 Grant Announcements','Applying for a New SAMHSA Grant','Grant Review Process','Continuation Grants','Grants Management','GPRA Measurement Tools','Contact Grants','More Grants Information',
                            'Register','Search','Apply','Grants.gov');
        foreach($categories as $option){
            $optionVisible = $this->HomePage->isVisible($this->HomePage->grantMenuOptions($option));
            $this->assertTrue($optionVisible,'Grant category: '.$option.' is not seen');
        }
        $imgVisible = $this->HomePage->isVisible($this->HomePage->grantMenuOptionsImage());
        $this->assertTrue($imgVisible,'Grant.gov image is not seen');
    }
    /**
     * @Given /^Category for Programs & Campaign, "(?P<option>(?:[^"]|\\")*)" is seen$/
     * @Given /^All valid Programs & Campaign categories are seen$/
     */
    public function ProgramsAndCampaignMenuOptionsVisible()
    {
        $categories = array('Featured Campaign','Popular Programs, Campaigns, & Initiatives','Popular Technical Assistance & Resource Centers');
        foreach($categories as $option){
            if($option=='Popular Programs, Campaigns, & Initiatives'){
                $optionVisible = $this->HomePage->isVisible('.//div[@qtip]//div[@class="mega-header"]/a[contains(text(),"Popular Programs, Campaigns,")]');
                $this->assertTrue($optionVisible,'Programs & Campaign category: '.$option.' is not seen');
            }else{
                $optionVisible = $this->HomePage->isVisible($this->HomePage->programsAndCampaignsMenuOptions($option));
                $this->assertTrue($optionVisible,'Programs & Campaign category: '.$option.' is not seen');
            }
        }
        $links = array('Recovery Month','View All Programs & Campaigns');
        foreach($links as $option) {
            $linksVisible = $this->HomePage->isVisible($this->HomePage->programsAndCampaignsMenuOptionsOtherLinks($option));
            $this->assertTrue($linksVisible, 'Programs & Campaign link: ' . $option . ' is not seen');
        }
        $imgVisible = $this->HomePage->isVisible($this->HomePage->programsAndCampaignsMenuOptionsImage());
        $this->assertTrue($imgVisible, 'Programs & Campaign image is not seen');
    }
    /**
     * @Given /^Category for About Us, "(?P<option>(?:[^"]|\\")*)" is seen$/
     *  @Given /^All valid About Us categories are seen$/
     */
    public function AboutMenuOptionsVisible()
    {
        $categories = array('Who We Are','Interagency Activities','Advisory Councils','Strategic Initiatives','Budget','Speeches and presentations','Jobs & Internships','Contact Us');
        foreach($categories as $option){
            $optionVisible = $this->HomePage->isVisible($this->HomePage->aboutUsMenuOptions($option));
            $this->assertTrue($optionVisible,'About Us category: '.$option.' is not seen');
        }
    }

}

