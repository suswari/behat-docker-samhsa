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

class ISMICCPage extends CommonActions {
    protected $path = '/ismicc';
    public function __construct(Session $session, Factory $factory, array $parameters = array())
    {
        parent::__construct($session, $factory, $parameters);
        $this->setPageTimeOut();
    }

    //##############################################################################
    //#######################      Page elements Xpath      ########################
    //##############################################################################
    public function ContentAssistanceLinks($name){
        return './/div[@class="field__items"]//a[normalize-space(text())="'.$name.'"]';
    }
    public $SideBlockISMICC2017ReportHeading ='.//div[@id="block-nodeblock-240344"]//h2[text()="ISMICC 2017 Report to Congress"]';
    public $SideBlockISMICC2017ReportImage ='.//div[@id="block-nodeblock-240344"]//a//img[@alt="ISMICC 2017 Report to Congress report cover"]';
    public $SideBlockISMICC2017ReportLink ='.//div[@id="block-nodeblock-240344"]//a[text()="Download the ISMICC 2017 Report to Congress (PDF | 4.37 MB)"]';



    //##############################################################################
    //#######################      Page methods             ########################
    //##############################################################################




}