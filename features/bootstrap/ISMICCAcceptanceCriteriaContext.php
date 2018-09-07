<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Pages\CommonPageElements;
use Pages\SAMSHAHomePage;
use Pages\ProgramAndCampaignsPage;
use Pages\ISMICCPage;

/**
 * Defines application features from the specific context.
 */
class ISMICCAcceptanceCriteriaContext extends PHPUnit_Framework_TestCase implements Context
{
    public $HomePage;
    public $ISMICCPage;
    public $CommonPageElements;
    public $ProgramsAndCampaignsPage;

    public function __construct(SAMSHAHomePage $HomePage, ISMICCPage $ISMICCPage,CommonPageElements $CommonPageElements, ProgramAndCampaignsPage $ProgramsAndCampaignsPage)
    {
        $this->HomePage = $HomePage;
        $this->ISMICCPage = $ISMICCPage;
        $this->CommonPageElements = $CommonPageElements;
        $this->ProgramsAndCampaignsPage = $ProgramsAndCampaignsPage;

    }


    /**
     * @When /^The user searches for Programs & Campaigns page using Keyword:"(?P<f1>(?:[^"]|\\")*)" Type:"(?P<f2>(?:[^"]|\\")*)" Topic:"(?P<f3>(?:[^"]|\\")*)"$/
     */
    public function searchProgramsAndCampaigns($f1,$f2,$f3)
    {
            if($f1){
                $this->ProgramsAndCampaignsPage->type($this->ProgramsAndCampaignsPage->SearchByKeywordTextField,$f1);
            }
            if($f2){
                $this->ProgramsAndCampaignsPage->selectDropdownOptionByText($this->ProgramsAndCampaignsPage->SearchByTypeDropdown,$f2);
            }
            if($f3){
                $this->ProgramsAndCampaignsPage->selectDropdownOptionByText($this->ProgramsAndCampaignsPage->SearchByTopicDropdown,$f3);
            }
            $this->ProgramsAndCampaignsPage->click($this->ProgramsAndCampaignsPage->SearchFindButton);
            $this->ProgramsAndCampaignsPage->waitForTime(2000);

    }

    /**
     * @When /^The Programs & Campaigns page search results shows "(?P<name>(?:[^"]|\\")*)" icon$/
     */
    public function programIconVisible($name)
    {
        $visible = $this->ProgramsAndCampaignsPage->isVisible($this->ProgramsAndCampaignsPage->ProgramIcon($name));
        $this->assertEquals($visible,true,'The program icon for '.$name.' is not visible');

    }

    /**
     * @When /^The Programs & Campaigns page search results shows "(?P<title>(?:[^"]|\\")*)" title & short summary block$/
     */
    public function programTitleAndShortDescriptionBlockVisible($title)
    {
        $visible = $this->ProgramsAndCampaignsPage->isVisible($this->ProgramsAndCampaignsPage->ProgramSummaryBlock($title));
        $this->assertEquals($visible,true,'The program title or summary block for '.$title.' is not visible');

    }

    /**
     * @Given /^The user sees for the subheading "(?P<heading>(?:[^"]|\\")*)" on ISMICC page there is a link "(?P<link>(?:[^"]|\\")*)"$/
     */
    public function VerifySubHeadingsWithSpecificLinksInBodyPresent($heading,$link)
    {
            if($link == 'Get the report'){
                $visible = $this->CommonPageElements->isVisible('.//a[text()="Get the report (PDF | 4.37 MB)"]/../preceding-sibling::h2[1]');
                $text = $this->CommonPageElements->getFieldText('.//a[text()="Get the report (PDF | 4.37 MB)"]/../preceding-sibling::h2[1]');
            }else{
                $visible = $this->CommonPageElements->isVisible('.//a[text()="'.$link.'"]/../preceding-sibling::h2[1]');
                $text = $this->CommonPageElements->getFieldText('.//a[text()="'.$link.'"]/../preceding-sibling::h2[1]');

            }

            $this->assertEquals($visible,true,'The link for '.$link.' is not visible');

            if($text !== $heading){
                $this->assertTrue(false , 'The subheading :'.$heading.' has no link :'.$row['links']);
            }
    }

    /**
     * @Given /^The following content assistance "(?P<linkName>(?:[^"]|\\")*)" are accessed$/
     */
    public function AccessISMICCContentAssistanceLinks($linkName)
    {
        if($linkName == 'Get the report'){
            $this->ISMICCPage->click($this->ISMICCPage->ContentAssistanceLinks("Get the report (PDF | 4.37 MB)"));
            $this->ISMICCPage->waitForTime(2000);
        }else {
            $this->ISMICCPage->click($this->ISMICCPage->ContentAssistanceLinks($linkName));
            $this->ISMICCPage->waitForTime(2000);
        }

    }

    /**
     * @Given /^On the side block of the ISMICC page the user sees the subheading “ISMICC 2017 Report to Congress”$/
     */
    public function SideBlockISMICC2017ReportHeadingPresent()
    {
        $visible = $this->ISMICCPage->isVisible($this->ISMICCPage->SideBlockISMICC2017ReportHeading);
        $this->assertEquals($visible,true,'the subheading “ISMICC 2017 Report to Congress” is not visible');

    }

    /**
     * @Given /^On the side block of the ISMICC page the user sees a linked image for ISMICC 2017 Report to Congress report cover$/
     */
    public function SideBlockISMICC2017ReportImagePresent()
    {
        $visible = $this->ISMICCPage->isVisible($this->ISMICCPage->SideBlockISMICC2017ReportImage);
        $this->assertEquals($visible,true,'the ISMICC 2017 Report Image is not visible');

    }


    /**
     * @Given /^On the side block of the ISMICC page the user sees the link Download the ISMICC 2017 Report to Congress pdf$/
     */
    public function SideBlockISMICC2017ReportLinkPresent()
    {
        $visible = $this->ISMICCPage->isVisible($this->ISMICCPage->SideBlockISMICC2017ReportLink);
        $this->assertEquals($visible,true,'the ISMICC 2017 Report Link is not visible');
    }

    /**
     * @Given /^The user clicks the link "(?P<linkName>(?:[^"]|\\")*)" from the ISMICC 2017 Report block$/
     */
    public function ClickISMICC2017ReportLink($linkName)
    {
        $this->ISMICCPage->click($this->ISMICCPage->SideBlockISMICC2017ReportLink);
    }

    /**
     * @Given /^The user clicks on the ISMICC 2017 Report cover image$/
     */
    public function ClickISMICC2017ReportCoverImage()
    {
        $this->ISMICCPage->click($this->ISMICCPage->SideBlockISMICC2017ReportImage);
    }
}
