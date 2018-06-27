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