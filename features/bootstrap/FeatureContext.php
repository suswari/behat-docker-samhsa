<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\Behat\Hook\Scope\AfterStepScope;
use Pages\CommonPageElements;
use Pages\SAMSHAHomePage;
use Pages\CommonActions;


/**
 * Defines application features from the specific context.
 */
class FeatureContext extends PHPUnit_Framework_TestCase implements Context
{

    public $HomePage;
    public $CommonPageElements;
    public $CommonActions;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct(SAMSHAHomePage $HomePage,CommonPageElements $CommonPageElements,CommonActions $commonActions)
    {
        $this->HomePage = $HomePage;
        $this->CommonPageElements = $CommonPageElements;
        $this->CommonActions =$commonActions;
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
            $featureFolder = preg_replace('/\W/', '', $scope->getFeature()->getTitle());

            $scenarioName = $this->currentScenario->getTitle();
            $fileName = preg_replace('/\W/', '', $scenarioName) . '.png';

        if (!file_exists('reports/screenshots/' . $featureFolder)) {
            mkdir('reports/screenshots/' . $featureFolder, 0777, true);
            fopen('reports/screenshots/' . $featureFolder.'/'.$fileName, "w");

        }
             file_put_contents('reports/screenshots/'.$featureFolder.'/'.$fileName , $this->CommonActions->takeScreenShot());
    }

    /**
     * @Then /^The user sees the SAMHSA header logo$/
     */
    public function SAMHSAHeaderLogoPresent()
    {
        $visible = $this->HomePage->isVisible($this->HomePage->SAMHSAHeaderLogo);
        $this->assertEquals($visible,true,'The SAMHSA header logo is not visible');
    }

    /**
     * @Then /^The user sees the SAMHSA header$/
     */
    public function SAMHSAHeaderPresent()
    {
        $visible = $this->HomePage->isVisible($this->HomePage->SAMHSAHeader);
        $this->assertEquals($visible,true,'The SAMHSA header is not visible');
    }

    /**
     * @Given /^The user access SAMHSA homesite$/
     */
    public function accessSAMHSAHomeSite()
    {
        $this->HomePage->OpenHomePage();
    }

    /**
     * @Given /^The user access Mind Breeze page$/
     */
    public function accessMindBreezeSite()
    {
        $this->HomePage->openPage('/search_results');
    }


    /**
     * @Given /^The user access ISMICC page/
     */
    public function accessISMICCSite()
    {
        $this->HomePage->openPage('/ismicc');
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
        }elseif ($pagehint=='Programs & Campaigns page') {
            $this->HomePage->openPage('programs-campaigns');
        } elseif ($pagehint=='ISMICC page') {
            $this->HomePage->openPage('ismicc');
        }elseif ($pagehint=='Mind Breeze page') {
            $this->HomePage->openPage('search_results');
        }elseif ($pagehint=='Grant awards by state page') {
            $this->HomePage->openPage('grants-awards-by-state');
        }elseif ($pagehint=='About us') {
            $this->HomePage->openPage('about-us');
            $this->HomePage->waitForTime(1000);
        }

    }

    /**
     * @Given /^The user expects to be on "(?P<pagehint>(?:[^"]|\\")*)"$/
     */
    public function ExpectsToBeOnPage($pagehint)
    {
        $currentUrl=$this->CommonPageElements->getCurrentUrl();
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
        if(strpos($url,'http') !== false){
            $this->assertEquals($currenturl,$url,'');
        }else{
            $baseurl = $this->HomePage->getBaseUrl($url);
//            var_export($baseurl);
            $this->assertEquals($currenturl,$baseurl.$url,'');
        }

    }

    /**
     * @Given /^The user sees the helper "(?P<block>(?:[^"]|\\")*)/
     */
    public function HelperBlocksVisibility($block)
    {
            $imagevisible = $this->CommonPageElements->isVisible($this->CommonPageElements->HelperBlocksImages( $block));
            $this->assertEquals($imagevisible, true, '');
            if($block!='SAMHSA Behavioral Health Treatment Locator'){
                $helplinenumber = $this->CommonPageElements->getFieldText($this->CommonPageElements->HelperBlockerPhoneNumberText( $block));
                var_export($helplinenumber);
                $this->assertNotEquals($helplinenumber, null, '');
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
     */
    public function ClicksOnALink($linkname)
    {
        $this->CommonPageElements->click('.//a[text()="'.$linkname.'"]');
    }

    /**
     * @Given /^The "(?P<filterlabel>(?:[^"]|\\")*)" filter has the options "(?P<option>(?:[^"]|\\")*)"$/
     */
    public function VerifyOptionsForDropdown($filterlabel,$option)
    {
            try{
                $optionvisible = $this->CommonPageElements->isVisible($this->CommonPageElements->DropdownOptions($filterlabel).'[(normalize-space(text())="'.$option.'"]');
            }catch (Exception $exception){
                $optionvisible = $this->CommonPageElements->isVisible($this->CommonPageElements->DropdownOptions($filterlabel).'[text()="'.$option.'"]');
            }
            $this->assertEquals($optionvisible, true, 'could not find the following option:'.$option);
    }


    /**
     * @Given /^The user selects the filter "(?P<filterlabel>(?:[^"]|\\")*)" as "(?P<optiontext>(?:[^"]|\\")*)"$/
     */
    public function SelectFromDropdownByText($filterlabel,$optiontext)
    {
        $this->CommonPageElements->selectDropdownOptionByText($this->CommonPageElements->DropdownField($filterlabel),$optiontext);

    }
    /**
     * @Given /^The user selects the following set of filter criteria for EBP resources "(?P<f1>(?:[^"]|\\")*)" "(?P<f2>(?:[^"]|\\")*)" "(?P<f3>(?:[^"]|\\")*)" "(?P<f4>(?:[^"]|\\")*)"$/
     */
    public function SelectFromMutilpleDropdownsByText($f1,$f2,$f3,$f4){
//        $hash = $table->getRows();
//        $header = false;
//        $headerrow = [];
//        $datarow = [];
//
//        foreach ($hash as $row) {
//
//            if(!$header){
//                $headerrow = $row;
//                $header = true;
//            }else{
//                $datarow = $row;
//            }
//            if($datarow!=NULL){
//                for ($i = 0; $i <count($headerrow); $i++) {
//                    if($datarow[$i]!=NULL) {
//                        $this->CommonPageElements->selectDropdownOptionByText($this->CommonPageElements->DropdownField($headerrow[$i]), $datarow[$i]);
        $this->CommonPageElements->selectDropdownOptionByText($this->CommonPageElements->DropdownField('Topic Area'), $f1);
        $this->CommonPageElements->selectDropdownOptionByText($this->CommonPageElements->DropdownField('Populations'), $f2);
        $this->CommonPageElements->selectDropdownOptionByText($this->CommonPageElements->DropdownField('Target Audience'), $f3);
        $this->CommonPageElements->selectDropdownOptionByText($this->CommonPageElements->DropdownField('Resource Type'), $f4);


//                    }
//                }
//
//            }
//        }
    }
    /**
     * @Given /^(?:The users hits apply button|Perform a search)$/
     */
    public function ClickApplyButton()
    {
        $this->CommonPageElements->click($this->CommonPageElements->ApplyButton);
        $this->CommonPageElements->waitForTime(3000);

    }
//
//    /**
//     * @Given /^The user sees the subheading "(?P<subheading>(?:[^"]|\\")*)"$/
//     */
//    public function VerifySubHeadingsPresent($subheading)
//    {
//            $visible = $this->CommonPageElements->isVisible('.//h2[normalize-space(text())="'.$subheading.'"]');
//            $this->assertEquals($visible, true, 'could not find the following subheading:'.$subheading);
//    }
    /**
     * @Given /^The user sees the subheading "(?P<titleText>(?:[^"]|\\")*)"$/
     */
    public function VerifySubHeadingPresent($titleText)
    {
            $visible = $this->CommonPageElements->isVisible('.//h2[normalize-space(text())="'.$titleText.'"]');
            $this->assertEquals($visible, true, 'could not find the following subheading:'.$titleText);

    }

    /**
     * @Given /^The user see the main title "(?P<titleText>(?:[^"]|\\")*)"$/
     */
    public function VerifyHeadingsPresent($titleText)
    {
        $visible= $this->CommonPageElements->isVisible('.//h1[normalize-space(text())="'.$titleText.'"]');
        $this->assertEquals($visible, true, 'could not find the following heading:'.$titleText);

    }


    /**
     * @Given /^The user sees the text "CONNECT WITH SAMHSA:" as a label for socila media icons$/
     */
    public function HeaderConnectWithSamhsaTextVisible(){
        $visible = $this->CommonPageElements->isVisible($this->CommonPageElements->HeaderConnectWithSAMHSAText);
        $this->assertEquals($visible, true, 'could not find CONNECT WITH SAMHSA: label');

    }

    /**
     * @Given /^The user sees Social Media Icon "(?P<icon>(?:[^"]|\\")*)" in the header$/
     */
    public function HeaderSocialMediaIconsVisible($icon)
    {
            $visible = $this->CommonPageElements->isVisible($this->CommonPageElements->SocialMediaIcons($icon));
            $this->assertEquals($visible, true, 'could not find social media icon :'.$icon);
    }

    /**
     * @Given /^The user sees the search button for the SAMHSA search in the header$/
     */
    public function SAMHSASearchBoxButtonVisible()
    {
        $visible =     $this->CommonPageElements->isVisible($this->CommonPageElements->SAMHSASearchButton);
        $this->assertEquals($visible, true, 'could not find SAMHSA search button in the header');

    }

    /**
     * @Given /^The user sees the SAMHSA search box in the header$/
     */
    public function SAMHSASearchBoxVisible()
    {
        $visible =   $this->CommonPageElements->isVisible($this->CommonPageElements->SAMHSASearchBox);
        $this->assertEquals($visible, true, 'could not find SAMHSA search input field in the header');

    }

    /**
     * @Given /^The URI responds with 200 status code$/
     */
    public function CheckFor200()
    {
        $url =  $this->CommonActions->getCurrentUrl();
        $ch = curl_init();
        $options = array(
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING       => "",
            CURLOPT_AUTOREFERER    => true,
            CURLOPT_CONNECTTIMEOUT => 120,
            CURLOPT_TIMEOUT        => 120,
            CURLOPT_MAXREDIRS      => 10,
        );
        curl_setopt ($ch, CURLOPT_CAINFO, dirname(__FILE__)."/cacert.pem");
        curl_setopt_array( $ch, $options );
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ( $httpCode != 200 ){
            $this->assertTrue(false,"Return code is {$httpCode} \n"
                .curl_error($ch));
        }
        curl_close($ch);

    }


    /**
     * @Given /^A user access the URI "(?P<uri>(?:[^"]|\\")*)"$/
     */
    public function AccessTheURI($uri)
    {
       $this->HomePage->openPage($uri);
       $this->HomePage->waitForTime(1500);
    }



}
