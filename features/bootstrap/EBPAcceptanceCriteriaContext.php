<?php
/**
 * Created by PhpStorm.
 * User: sadla
 * Date: 5/29/18
 * Time: 2:16 PM
 */
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Pages\EBPResourceCentrePage;
use Pages\EBPResourceCenterAboutPage;
use Pages\ProgramAndCampaignsPage;
use Pages\SAMSHAHomePage;
use Pages\CommonPageElements;

//require_once 'PHPUnit/Framework/Assert/Functions.php';

class EBPAcceptanceCriteriaContext extends PHPUnit_Framework_TestCase implements Context
{
    public $HomePage;
    public $ProgramsCampaignsPage;
    public $EBPResourceCenterPage;
    public $EBPAboutPage;
    public $CommonPageElements;


    public function __construct(SAMSHAHomePage $HomePage, ProgramAndCampaignsPage $ProgramsCampaignsPage, EBPResourceCentrePage $EBPResourceCenterPage,EBPResourceCenterAboutPage $EBPResourceCenterAboutPage,CommonPageElements $CommonPageElements)
    {
        $this->HomePage = $HomePage;
        $this->ProgramsCampaignsPage = $ProgramsCampaignsPage;
        $this->EBPResourceCenterPage = $EBPResourceCenterPage;
        $this->EBPAboutPage = $EBPResourceCenterAboutPage;
        $this->CommonPageElements = $CommonPageElements;

    }



    /**
     * @When /^The user navigates to the "(?P<linkName>(?:[^"]|\\")*)" page from Programs & Campaigns$/
     */
    public function navigateFromProgramsAndCampaigns($linkName)
    {
        $this->HomePage->ClickProgramsAndCampaignsLink();
        $this->ProgramsCampaignsPage->ClickProgram($linkName);
    }

    /**
     * @Then /^The user sees the EBP banner at the top of the page$/
     */
    public function EBPBannerVisibility()
    {
        $visible = $this->EBPResourceCenterPage->isVisible($this->EBPResourceCenterPage->EBPBanner);
        $this->assertEquals($visible,true,'The EBP banner is not visible');
    }

    /**
     * @Then /^The user sees the title “Evidence-Based Practices Resources Center” is visible$/
     */
    public function EBPTitleVisibility()
    {
        $visible = $this->EBPResourceCenterPage->isVisible($this->EBPResourceCenterPage->EBPTitle);
        $this->assertEquals($visible,true,'The title “Evidence-Based Practices Resources Center” is not visible');

    }

    /**
     * @Then /^The user sees the EBP welcome statement below the title$/
     */
    public function EBPWelcomeStatementVisibility()
    {
        $visible = $this->EBPResourceCenterPage->isVisible($this->EBPResourceCenterPage->EBPWelcomeStatement);
        $this->assertEquals($visible,true,'The EBP welcome statement is not visible');

    }

    /**
     * @Then /^The user sees the sub heading “Filter Resources”$/
     */
    public function filterResourcesSubVisibility()
    {
        $visible = $this->EBPResourceCenterPage->isVisible($this->EBPResourceCenterPage->filterResourcesSubHeading);
        $this->assertEquals($visible,true,'The sub heading “Filter Resources” is not visible');

    }

    /**
     * @Then /^The user sees that all the EBP related document resources are listed below the filter section$/
     */
    public function EBPRelatedDocumentsBlockVisibility()
    {
        $visible = $this->EBPResourceCenterPage->isVisible($this->EBPResourceCenterPage->EBPRelatedDocumentsBlock);
        $this->assertEquals($visible,true,'The EBP related document resources that should be listed below the filter section are not visible');

    }

    /**
     * @Then /^The user sees the EBP “Technical Assistance” section to the right side of the page$/
     */
    public function EBPTechnicalAssistanceBlockVisibility()
    {
        $visible = $this->EBPResourceCenterPage->isVisible($this->EBPResourceCenterPage->EBPTechnicalAssistanceBlock);
        $this->assertEquals($visible,true,'The EBP “Technical Assistance” section is not visible');

    }

    /**
     * @Then /^The user sees the “Apply” button for the EBP filters$/
     */
    public function EBPFilterApplyButtonVisibility()
    {
        $visible = $this->EBPResourceCenterPage->isVisible($this->EBPResourceCenterPage->ApplyButton);
        $this->assertEquals($visible,true,'The EBP filter Apply button is not visible');
    }

    /**
     * @Then /^From the EBP filter section the user sees the filters (?P<filter>(?:[^"]|\\")*) and default selection (?P<selection>(?:[^"]|\\")*)$/
     */
    public function VerifyFilterLabelAndDefaultSelection($filter,$selection)
    {
            if ($filter == 'Topic Area') {
                $visible = $this->EBPResourceCenterPage->isVisible($this->EBPResourceCenterPage->TopicAreaFilterLabel);
                $defaultValue = $this->EBPResourceCenterPage->getSelectedTextFromDropdown($this->EBPResourceCenterPage->TopicAreaFilterDropdown);

            } elseif ($filter == 'Populations') {
                $visible = $this->EBPResourceCenterPage->isVisible($this->EBPResourceCenterPage->PopulationFilterLabel);
                $defaultValue = $this->EBPResourceCenterPage->getSelectedTextFromDropdown($this->EBPResourceCenterPage->PopulationFilterDropdown);
            } elseif ($filter == 'Target Audience') {
                $visible = $this->EBPResourceCenterPage->isVisible($this->EBPResourceCenterPage->TargetAudienceFilterLabel);
                $defaultValue = $this->EBPResourceCenterPage->getSelectedTextFromDropdown($this->EBPResourceCenterPage->TargetAudienceFilterDropdown);
            } elseif ($filter == 'Resource Type') {
                $visible = $this->EBPResourceCenterPage->isVisible($this->EBPResourceCenterPage->ResourceTypeFilterLabel);
                $defaultValue = $this->EBPResourceCenterPage->getSelectedTextFromDropdown($this->EBPResourceCenterPage->ResourceTypeFilterDropdown);
            }elseif ($filter == 'Sort by') {
                $visible = $this->EBPResourceCenterPage->isVisible($this->EBPResourceCenterPage->SortByFilterLabel);
                $defaultValue = $this->EBPResourceCenterPage->getSelectedTextFromDropdown($this->EBPResourceCenterPage->SortByFilterDropdown);
            }elseif ($filter == 'Items per page') {
                $visible = $this->EBPResourceCenterPage->isVisible($this->EBPResourceCenterPage->ItemsPerPageFilterLabel);
                $defaultValue = $this->EBPResourceCenterPage->getSelectedTextFromDropdown($this->EBPResourceCenterPage->ItemsPerPageFilterDropdown);
            }

            $this->assertEquals($visible, true, 'The EBP filter label ' . $filter . ' is not visible');
            $this->assertEquals($defaultValue, $selection, 'The EBP filter label ' . $filter . ' is not visible');
    }

    /**
     * @Given /^From the list of EBP resources the user sees the resource title come links$/
     * @Then /^The total number of resources listed per page is (?P<count>(?:[^"]|\\")*)$/
     */
    public function EBPResourcesTitleLinksVisible($count = 15)
    {
        $actualcount = $this->EBPResourceCenterPage->GetResourcesLinksCount();
        $this->assertEquals($count, $actualcount, 'There are not all resource link titles');
    }

    /**
     * @Given /^The resource records are sorted by title in ascending order by default$/
     */
    public function EBPResourcesTitleAreSorted()
    {
        $actualLinkTexts = $this->EBPResourceCenterPage->GetAllResourcesLinkText();
        $expectedLinkTexts = $actualLinkTexts;
        sort($expectedLinkTexts);
        $this->assertEquals($expectedLinkTexts, $expectedLinkTexts, 'The resource titles are not sorted in ascending order by default');
    }

    /**
     * @Given /^The user sees the resource description$/
     */
    public function EBPResourcesDescriptionVisible()
    {
        $actualDescriptions = $this->EBPResourceCenterPage->GetAllResourcesDescription();
        $this->assertEquals(count($actualDescriptions),15 , 'Some resource description is missing');
    }

    /**
     * @Given /^The user always sees the resource tags "(?P<t1>(?:[^"]|\\")*)" "(?P<t2>(?:[^"]|\\")*)" "(?P<t3>(?:[^"]|\\")*)" "(?P<t4>(?:[^"]|\\")*)"$/
     */
    public function EBPResourcesRequiredTags($t1,$t2,$t3,$t4)
    {
        $t1visible = $this->EBPResourceCenterPage->isVisible($this->EBPResourceCenterPage->TopicAreaResourceTag);
        $t2visible = $this->EBPResourceCenterPage->isVisible($this->EBPResourceCenterPage->PopulationResourceTag);
        $t3visible = $this->EBPResourceCenterPage->isVisible($this->EBPResourceCenterPage->TargetAudienceResourceTag);
        $t4visible = $this->EBPResourceCenterPage->isVisible($this->EBPResourceCenterPage->ResourceTypeResourceTag);
        $this->assertEquals($t1visible, true, 'The Resource tag ' . $t1 . ' is not visible');
        $this->assertEquals($t2visible, true, 'The Resource tag ' . $t2 . ' is not visible');
        $this->assertEquals($t3visible, true, 'The Resource tag ' . $t3 . ' is not visible');
        $this->assertEquals($t4visible, true, 'The Resource tag ' . $t4 . ' is not visible');
    }

    /**
     * @Given /^The user sees the "(?P<t1>(?:[^"]|\\")*)" "(?P<t2>(?:[^"]|\\")*)" resource tags only when their value is not blank$/
     */
    public function EBPResourcesDynamicTags($t1,$t2)
    {
        $t1visible = $this->EBPResourceCenterPage->GetSubstanceResourceTags();
        $t1notNULLValue = $this->EBPResourceCenterPage->GetSubstanceResourceTagsValue();
        $t2visible = $this->EBPResourceCenterPage->GetConditionsResourceTags();
        $t2notNULLValue = $this->EBPResourceCenterPage->GetConditionsResourceTagsValue();
        $this->assertEquals($t1visible, true, 'The Resource tag ' . $t1 . ' is not visible');
        $this->assertEquals($t2visible, true, 'The Resource tag ' . $t2 . ' is not visible');
        $this->assertNotEmpty($t1notNULLValue,'Substance resource tag value is empty');
        $this->assertNotEmpty($t2notNULLValue, 'Conditions resource tag value is empty');
    }

    /**
     * @Given /^In the Technical Assistance section on the right rail of the EBP page there are weblinks "(?P<linkName>(?:[^"]|\\")*)"$/
     */
    public function TechnicalAssistanceWeblinks($linkName)
    {
        $visible = $this->EBPResourceCenterPage->isVisible($this->EBPResourceCenterPage->TechnicalAssitanceLinks($linkName));
        $this->assertEquals($visible, true, 'The technical assistance link ' . $linkName . ' is not visible');
    }

    /**
     * @Given /^The user sees "(?P<linkName>(?:[^"]|\\")*)" in the Technical Assistance section$/
     */
    public function MoreTechnicalAssistanceWeblinks($linkName)
    {
        $visible = $this->EBPResourceCenterPage->isVisible($this->EBPResourceCenterPage->MoreTechnicalAssistanceLink($linkName));
        $this->assertEquals($visible, true, 'The technical assistance link ' . $linkName . ' is not visible');
    }

    /**
     * @Given /^The following Technical Assistance "(?P<linkName>(?:[^"]|\\")*)" are accessed$/
     */
    public function AccessTechnicalAssistanceLinks($linkName)
    {
        if($linkName=='View more technical assistance resources on the SAMHSA Knowledge Network'){
            $this->EBPResourceCenterPage->click($this->EBPResourceCenterPage->MoreTechnicalAssistanceLink($linkName));
            $this->EBPResourceCenterPage->waitForTime(2000);
        }else {
            $this->EBPResourceCenterPage->click($this->EBPResourceCenterPage->TechnicalAssitanceLinks($linkName));
            $this->EBPResourceCenterPage->waitForTime(2000);
        }
    }

    /**
     * @Given /^The user sees the EBP about page title as "(?P<title>(?:[^"]|\\")*)"$/
     */
    public function EBPAboutPageTitleVisible($title)
    {
        $visible = $this->EBPAboutPage->isVisible($this->EBPAboutPage->EBPAboutTitle);
        $text = $this->EBPAboutPage->getFieldText($this->EBPAboutPage->EBPAboutTitle);
        $this->assertEquals($visible, true, '');
        $this->assertEquals($text, $title, '');
    }


    /**
     * @Given /^The user sees the EBP about page description text "(?P<description>(?:[^"]|\\")*)"$/
     */
    public function EBPAboutPageDescriptionVisible($description)
    {
        $visible = $this->EBPAboutPage->isVisible($this->EBPAboutPage->EBPSummaryBlock);
        $text = $this->EBPAboutPage->getFieldText($this->EBPAboutPage->EBPSummaryBlock);
        $this->assertEquals($visible, true, '');
        $this->assertEquals($text, $description, '');
    }

    /**
     * @Given /^The user sees the Sidebar navigation link "(?P<link>(?:[^"]|\\")*)"$/
     */
    public function SidebarNavigationLinksVisible($link)
    {
        $sidebarvisible = $this->EBPAboutPage->isVisible($this->EBPAboutPage->LetPaneNavigationBlock);
        $linkvisible = $this->EBPAboutPage->isVisible($this->EBPAboutPage->LetPaneNavigationBlock.'//a[text()="'.$link.'"]');
        $this->EBPAboutPage->waitForTime(1000);
        $this->assertEquals($sidebarvisible, true, 'sidebar block is not visible');
        $this->assertEquals($linkvisible, true, 'the link '.$link.' is not visible');
    }
    /**
     * @Given /^The user sees the EBP about page text$/
     */
    public function EBPAboutPageTextVisible(){
        $visible = $this->EBPAboutPage->isVisible($this->EBPAboutPage->EBPDescriptionBlock);
        $this->assertEquals($visible, true, 'EBP about page text block is not visible');

    }
    /**
     * @Given /^The user clicks the link "(?P<linkname>(?:[^"]|\\")*)" from the sidebar navigation$/
     */
    public function ClickSideBarNavigationLinks($linkname)
    {
        $this->EBPAboutPage->click($this->EBPAboutPage->LetPaneNavigationBlock.'//a[text()="'.$linkname.'"]');

    }

    /**
     * @Given /^The user expands on the "(?P<filtername>(?:[^"]|\\")*)" filter from the EBP filter section$/
     */
    public function ExpandEBPFilterSection($filtername)
    {
        var_export($this->CommonPageElements->DropdownField($filtername));
        $this->EBPResourceCenterPage->click($this->CommonPageElements->DropdownField($filtername));
    }


    /**
     * @Given /^The user sees the resource list is sorted by title in the descending order of alphabets$/
     */
    public function EBPResourcesTitleAreSortedDescending()
    {
        $actualLinkTexts = $this->EBPResourceCenterPage->GetAllResourcesLinkText();
        $expectedLinkTexts = $actualLinkTexts;
        rsort($expectedLinkTexts);
        $this->assertEquals($expectedLinkTexts, $actualLinkTexts, 'The resource titles are not sorted in descending order');
    }

    /**
     * @Given /^The user sees either results for EBP resources or the text “Sorry, we could not find any resources that matched your search. Please try again.”$/
     */
    public function ViewEBPResourceFilterResults()
    {
        $resultsvisible = $this->EBPResourceCenterPage->isVisible($this->EBPResourceCenterPage->EBPRelatedDocumentsBlock);
        $textvisible = $this->EBPResourceCenterPage->isVisible('.//*[text()="Sorry, we could not find any resources that matched your search. Please try again."]');
        if($resultsvisible && $textvisible){
            $this->assertTrue(1==0, 'There results are seen along with text "Sorry, we could not find any resources that matched your search"');
        }else if(!$resultsvisible && !$textvisible){
            $this->assertTrue(1==0, 'There results are not seen along with text "Sorry, we could not find any resources that matched your search"');
        }
    }

    /**
     * @Given /^The user sees the results are refreshed everytime for a new search$/
     */
    public function EBPResourceFilterResultsAreRefreshed()
    {
        $searchList = $this->EBPResourceCenterPage->GetAllResourcesLinkText();
        $this->CommonPageElements->selectDropdownOptionByText($this->CommonPageElements->DropdownField('Topic Area'), '- All -');
        $this->CommonPageElements->selectDropdownOptionByText($this->CommonPageElements->DropdownField('Populations'), '- All -');
        $this->CommonPageElements->selectDropdownOptionByText($this->CommonPageElements->DropdownField('Target Audience'), '- All -');
        $this->CommonPageElements->selectDropdownOptionByText($this->CommonPageElements->DropdownField('Resource Type'), '- All -');
        $this->CommonPageElements->selectDropdownOptionByText($this->CommonPageElements->DropdownField('Sort by'), 'Title A->Z');
        $this->CommonPageElements->selectDropdownOptionByText($this->CommonPageElements->DropdownField('Items per page'), "15");
        $this->CommonPageElements->click($this->CommonPageElements->ApplyButton);
        $this->CommonPageElements->waitForTime(3000);
        $defaultList = $this->EBPResourceCenterPage->GetAllResourcesLinkText();
            $this->assertNotEquals($searchList,$defaultList, 'The filter results are not refreshed"');

    }
}
