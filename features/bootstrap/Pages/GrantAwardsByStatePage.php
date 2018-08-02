<?php
/**
 * Created by PhpStorm.
 * User: sadla
 * Date: 5/29/18
 * Time: 4:43 PM
 */

namespace Pages;

use Behat\Mink\Session;
use SensioLabs\Behat\PageObjectExtension\PageObject\Factory;

class GrantAwardsByStatePage extends CommonActions {
    protected $path = '/';
    public function __construct(Session $session, Factory $factory, array $parameters = array())
    {
        parent::__construct($session, $factory, $parameters);
        $this->setPageTimeOut();
    }

    //##############################################################################
    //#######################      Page elements Xpath      ########################
    //##############################################################################

    public function fiscalYearsLink($year){
      return ".//h2[text()='View Grant Awards By Fiscal Year: ']/a[text()='".$year."']";
    }
    public function USAStates($state){
        return ".//area[@title='".$state."']";
    }

    public function grantSummaryBlock($title){
        return ".//h2[@class='block__title' and text()='".$title."']/following-sibling::div[@class='block__content']";
    }

    public $discretionaryFundsLink = ".//a[text()='This is a summary, click here for Discretionary Funds in Detail']";
    public $nonDiscretionaryFundsLink = ".//a[text()='This is a summary, click here for Non-Discretionary Funds in Detail']";
    public $grantsDetailsBlocks = ".//div[starts-with(@class,'views-row views-row-')]";


    //##############################################################################
    //#######################      Page methods             ########################
    //##############################################################################



}