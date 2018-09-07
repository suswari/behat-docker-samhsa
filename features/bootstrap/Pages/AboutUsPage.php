<?php
/**
 * Created by PhpStorm.
 * User: sadla
 * Date: 8/24/18
 * Time: 2:08 PM
 */

namespace Pages;

use Behat\Mink\Session;
use SensioLabs\Behat\PageObjectExtension\PageObject\Factory;

class AboutUsPage extends CommonActions {
    protected $path = '/';
    public function __construct(Session $session, Factory $factory, array $parameters = array())
    {
        parent::__construct($session, $factory, $parameters);
        $this->setPageTimeOut();
    }

    //##############################################################################
    //#######################      Page elements Xpath      ########################
    //##############################################################################
    public $mapQuestIframe = ".//iframe[@title='SAMHSA on Mapquest']";
    public $mapQuestWindow = ".//div[@id='map_main']";

    //##############################################################################
    //#######################      Page methods             ########################
    //##############################################################################


}