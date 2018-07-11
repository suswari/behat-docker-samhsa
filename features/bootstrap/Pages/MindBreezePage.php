<?php
/**
 * Created by PhpStorm.
 * User: sadla
 * Date: 7/2/18
 * Time: 3:11 PM
 */

namespace Pages;
use Behat\Mink\Session;
use SensioLabs\Behat\PageObjectExtension\PageObject\Factory;

class MindBreezePage extends CommonActions {
    protected $path = '/search_results';
    public function __construct(Session $session, Factory $factory, array $parameters = array())
    {
        parent::__construct($session, $factory, $parameters);
        $this->setPageTimeOut();
    }

    //##############################################################################
    //#######################      Page elements Xpath      ########################
    //##############################################################################

    public function getProgramsAndCampaignsLinkXpath ($linkName){
        return './/a[text()="'.$linkName.'"]';
    }

    //##############################################################################
    //#######################      Page methods             ########################
    //##############################################################################


    public function ClickProgram($programName){
        $this->click($this->getProgramsAndCampaignsLinkXpath($programName));
    }

}