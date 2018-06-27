<?php
/**
 * Created by PhpStorm.
 * User: sadla
 * Date: 5/29/18
 * Time: 4:43 PM
 */

namespace Page;

use Behat\Mink\Session;
use SensioLabs\Behat\PageObjectExtension\PageObject\Factory;

class SAMSHAHomePage extends CommonActions {
    protected $path = '/';
    public function __construct(Session $session, Factory $factory, array $parameters = array())
    {
        parent::__construct($session, $factory, $parameters);
        $this->setPageTimeOut();
    }

    //##############################################################################
    //#######################      Page elements Xpath      ########################
    //##############################################################################

    public $programsAndCampaingsLink = ".//a[text()='Programs & Campaigns']";
    public $SAMHSAHeaderLogoPresent = ".//img[@id='top-logo']";


    //##############################################################################
    //#######################      Page methods             ########################
    //##############################################################################


    public function ClickProgramsAndCampaignsLink(){
        $this->click($this->programsAndCampaingsLink);
    }

    public function OpenHomePage(){
            $this->openPage('/');
    }

}