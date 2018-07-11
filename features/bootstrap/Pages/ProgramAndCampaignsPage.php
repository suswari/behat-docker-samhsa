<?php
/**
 * Created by PhpStorm.
 * User: sadla
 * Date: 5/29/18
 * Time: 4:54 PM
 */


namespace Page;

use Behat\Mink\Session;
use SensioLabs\Behat\PageObjectExtension\PageObject\Factory;

class ProgramAndCampaignsPage extends CommonActions {
    protected $path = '/programs-campaigns';
    public function __construct(Session $session, Factory $factory, array $parameters = array())
    {
        parent::__construct($session, $factory, $parameters);
        $this->setPageTimeOut();
    }

    //##############################################################################
    //#######################      Page elements Xpath      ########################
    //##############################################################################

    public function ProgramsAndCampaignsLinkXpath ($linkName){
        return './/a[text()="'.$linkName.'"]';
    }
    public $SearchByKeywordTextField = './/*[@id="edit-field-summary-value"]';
    public $SearchByTypeDropdown = './/*[@id="edit-field-pc-type-tid"]';
    public $SearchByTopicDropdown = './/*[@id="edit-field-pc-topic-tid"]';
    public function ProgramIcon($name){
        return './/a[@href="/'.$name.'"]/img[@typeof="foaf:Image"]';
    }
    public function ProgramSummaryBlock($name){
        return './/a[text()="'.$name.'"]/../../*[@class="pc-field-summary"]';
    }
    public $SearchFindButton = ".//*[@id='edit-submit-programs-campaigns']";

    //##############################################################################
    //#######################      Page methods             ########################
    //##############################################################################


    public function ClickProgram($programName){
        $this->click($this->ProgramsAndCampaignsLinkXpath($programName));
    }

}