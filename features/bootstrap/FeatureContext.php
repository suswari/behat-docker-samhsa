<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\Mink\Exception\DriverException;
use Behat\Mink\Exception\UnsupportedDriverActionException;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\Behat\Hook\Scope\AfterStepScope;
use Page\EBPResourceCentrePage;
use Page\ProgramAndCampaignsPage;
use Page\CommonPageElements;
use Page\SAMSHAHomePage;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends PHPUnit_Framework_TestCase implements Context
{

    public $HomePage;
    public $CommonPageElements;


    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct(SAMSHAHomePage $HomePage,CommonPageElements $CommonPageElements)
    {
        $this->HomePage = $HomePage;
        $this->CommonPageElements = $CommonPageElements;
    }


    public $currentScenario;

    /**
     * @BeforeScenario
     *
     * @param BeforeScenarioScope $scope
     *
     */
    public function setUpTestEnvironment($scope)
    {
        $this->currentScenario = $scope->getScenario();

    }

    /**
     * @AfterStep
     *
     * @param AfterStepScope $scope
     */
    public function afterStep($scope)
    {
        //if test has failed, and is not an api test, get screenshot
        if(!$scope->getTestResult()->isPassed())
        {
            //create filename string

            $featureFolder = preg_replace('/\W/', '', $scope->getFeature()->getTitle());

            $scenarioName = $this->currentScenario->getTitle();
            $fileName = preg_replace('/\W/', '', $scenarioName) . '.png';

            //create screenshots directory if it doesn't exist
            if (!file_exists('reports/screenshots/' . $featureFolder)) {
                mkdir('reports/screenshots/' . $featureFolder);
            }
//            $driver = $this->getSession()->getDriver();
//            $driver = $this->getDgetDriver();

            //take screenshot and save as the previously defined filename
//            $this->driver->takeScreenshot('results/html/assets/screenshots/' . $featureFolder . '/' . $fileName);
            // For Selenium2 Driver you can use:
//            try {
//                $screenshot = $driver->getScreenshot();
//            } catch (UnsupportedDriverActionException $e) {
//            } catch (DriverException $e) {
//            }
//            file_put_contents('reports/tmp/test.png', base64_decode($screenshot));
        }
    }


    /**
     * @Then /^The user sees the SAMHSA header logo$/
     */
    public function SAMHSAHeaderLogoPresent()
    {
        $visible = $this->HomePage->isVisible($this->HomePage->SAMHSAHeaderLogoPresent);
        $this->assertEquals($visible,true,'The SAMHSA header logo is not visible');
    }

    /**
     * @Given /^The user access SAMHSA homesite$/
     */
    public function accessSAMHSAHomeSite()
    {
        $this->HomePage->OpenHomePage();
    }

    /**
     * @Given /^The user is on the "(?P<pagehint>(?:[^"]|\\")*)"$/
     * @Given /^The user access "(?P<pagehint>(?:[^"]|\\")*)"$/
     */
    public function accessPage($pagehint)
    {
        if($pagehint=='EBP Resource Center page') {
            $this->HomePage->openPage('ebp-resource-center');
        }elseif ($pagehint=='EBP about page') {
            $this->HomePage->openPage('ebp-resource-center/about');
        }

    }

    /**
     * @Given /^The user expects to be on "(?P<pagehint>(?:[^"]|\\")*)"$/
     */
    public function ExpectsToBeOnPage($pagehint)
    {
        $currentUrl=$this->CommonPageElements->getCurrentUrl();
        var_export($currentUrl);
//        $baseUrl=$this->CommonPageElements->getBaseUrl($pagehint);
//        var_export($baseUrl);

        if($pagehint == 'EBP about page'){
            $this->assertStringEndsWith('ebp-resource-center/about',$currentUrl,'');
        }elseif ($pagehint=='EBP Resource Center page') {
            $this->assertStringEndsWith('ebp-resource-center',$currentUrl,'');
        }

    }


    /**
     * @Given /^The user sees the "(?P<textBetterKnownAs>(?:[^"]|\\")*)" text for landing page$/
     */
    public function multilineTextVisible($textBetterKnownAs, PyStringNode $markdown)
    {
        $visible = $this->HomePage->isVisible('.//*[text()="'.$markdown->getRaw().'"]');
        $this->assertEquals($visible,true,'The '.$textBetterKnownAs.' text '.$markdown->getRaw().' is not visible');
    }


    /**
     * @Given /^The user sees the following text "(?P<text>(?:[^"]|\\")*)"$/
     */
    public function TextVisible($text)
    {
        $visible = $this->HomePage->isVisible('.//*[text()="'.$text.'"]');
        $this->assertEquals($visible,true,'The "'.$text.'" text is not visible');
    }

    /**
     * @Given /^The user sees the link "(?P<linkText>(?:[^"]|\\")*)"$/
     */
    public function linkVisible($linkText)
    {
        $visible = $this->HomePage->isVisible('.//a[text()="'.$linkText.'"]');
        $this->assertEquals($visible,true,'The link '.$linkText.' is not visible');

    }

    /**
     * @Given /^The user sees the breadcrumb link for "(?P<breadCrumbText>(?:[^"]|\\")*)" as main node$/
     */
    public function breadCrumbVisibleAndIsMainNode($breadCrumbText)
    {
        $visible = $this->HomePage->isVisible('.//div[@class="breadcrumb" and contains(text(),"'.$breadCrumbText.'")]');
        $this->assertEquals($visible,true,'The breadcrumb text'.$breadCrumbText.' is not visible or is not the main node');

    }

    /**
     * @Given /^The user sees the breadcrumb link for "(?P<breadCrumbText>(?:[^"]|\\")*)" as parent nodes$/
     */
    public function breadCrumbVisibleAndIsParentNode($breadCrumbText)
    {
        $visible = $this->HomePage->isVisible('.//div[@class="breadcrumb"]/a[text()="'.$breadCrumbText.'"]');
        $this->assertEquals($visible,true,'The breadcrumb text'.$breadCrumbText.' is not visible or is not the parent node');
    }


    /**
     * @Given /^The link opens in the same tab with the "(?P<url>(?:[^"]|\\")*)"$/
     */
    public function LinkOpensInSameTabWithUrl($url)
    {
       $currenturl =  $this->HomePage->getCurrentUrl();
//       var_export($currenturl);
        $this->assertEquals($currenturl,$url,'');
    }

    /**
     * @Given /^The user sees the following helper blocks$/
     */
    public function HelperBlocksVisibility(TableNode $table)
    {
        $hash = $table->getHash();
        foreach ($hash as $row) {
            $imagevisible = $this->CommonPageElements->isVisible($this->CommonPageElements->HelperBlocksImages( $row['blocks']));
            $this->assertEquals($imagevisible, true, '');
            if($row['blocks']!='SAMHSA Behavioral Health Treatment Locator'){
                $helplinenumber = $this->CommonPageElements->getFieldText($this->CommonPageElements->HelperBlockerPhoneNumberText( $row['blocks']));
                var_export($helplinenumber);
                $this->assertNotEquals($helplinenumber, null, '');
            }
        }
    }

    /**
     * @Given /^The user sees the page number links at the bottom of the page$/
     */
    public function PaginationLinksVisibility()
    {
            $linksvisible = $this->CommonPageElements->isVisible($this->CommonPageElements->PaginationLinks());
            $this->assertEquals($linksvisible, true, '');
    }

    /**
     * @Given /^The user sees the "(?P<linkname>(?:[^"]|\\")*)" pagination link$/
     */
    public function PaginationLinkWithNameVisibility($linkname)
    {
        $linksvisible = $this->CommonPageElements->isVisible($this->CommonPageElements->PaginationLinks($linkname));
        $this->assertEquals($linksvisible, true, '');
    }

    /**
     * @Given /^The user clicks on "(?P<linkname>(?:[^"]|\\")*)" link for the next page(?:| EBP resources)$/
     */
    public function ClickPaginationLink($linkname)
    {
        $this->CommonPageElements->click($this->CommonPageElements->PaginationLinks($linkname));
        $this->CommonPageElements->waitForTime(3000);
    }

    /**
     * @Given /^The user sees the SAMHSA footer at the bottom of the page$/
     */
    public function SAMHSAFooterVisible()
    {
        $footervisible = $this->CommonPageElements->isVisible($this->CommonPageElements->SAMHSAFooter);
        $this->assertEquals($footervisible, true, '');
        $bottomfootervisible = $this->CommonPageElements->isVisible($this->CommonPageElements->SAMHSABottomFooter);
        $this->assertEquals($bottomfootervisible, true, '');
    }

    /**
     * @Given /^The user clicks the link "(?P<linkname>(?:[^"]|\\")*)"$/
    $/
     */
    public function ClicksOnALink($linkname)
    {
       $this->CommonPageElements->click('.//a[text()="'.$linkname.'"]');
    }

    /**
     * @Given /^The "(?P<filterlabel>(?:[^"]|\\")*)" filter has the following options$/
    $/
     */
    public function VerifyOptionsForDropdown($filterlabel,TableNode $table)
    {
        $hash = $table->getHash();
        foreach ($hash as $row) {
            try{
                $optionvisible = $this->CommonPageElements->isVisible($this->CommonPageElements->DropdownOptions($filterlabel).'[(normalize-space(text())="'.$row['Options'].'"]');
            }catch (Exception $exception){
                 $optionvisible = $this->CommonPageElements->isVisible($this->CommonPageElements->DropdownOptions($filterlabel).'[text()="'.$row['Options'].'"]');
            }
            $this->assertEquals($optionvisible, true, 'could not find the following option:'.$row['Options']);
        }
    }

    /**
     * @Given /^The user selects the filter "(?P<filterlabel>(?:[^"]|\\")*)" as "(?P<optiontext>(?:[^"]|\\")*)"$/
    $/
     */
    public function SelectFromDropdownByText($filterlabel,$optiontext)
    {
        $this->CommonPageElements->selectDropdownOptionByText($this->CommonPageElements->DropdownField($filterlabel),$optiontext);

    }
    /**
     * @Given /^The user selects the following set of filter criteria for "(?P<filterlabel>(?:[^"]|\\")*)"$/
    $/
     */
    public function SelectFromMutilpleDropdownsByText(TableNode $table){
        $hash = $table->getRows();
        $header = false;
        $headerrow = [];
        $datarow = [];
        foreach ($hash as $row) {

            if(!$header){
                $headerrow = $row;
                $header = true;
            }else{
                $datarow = $row;
            }
            if($datarow!=NULL){
                for ($i = 0; $i <count($headerrow); $i++) {
                    if($datarow[$i]!=NULL) {
                        $this->CommonPageElements->selectDropdownOptionByText($this->CommonPageElements->DropdownField($headerrow[$i]), $datarow[$i]);
                    }
                }

            }
        }
    }
    /**
     * @Given /^The users hits apply button$/
    $/
     */
    public function ClickApplyButton()
    {
        $this->CommonPageElements->click($this->CommonPageElements->ApplyButton);
        $this->CommonPageElements->waitForTime(3000);

    }
}
