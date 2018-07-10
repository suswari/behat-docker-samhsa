<?php

/**
 * Created by PhpStorm.
 * User: sadla
 * Date: 5/30/18
 * Time: 12:02 PM
 */


namespace Page;

use Behat\MinkExtension\Context\RawMinkContext;
use SensioLabs\Behat\PageObjectExtension\PageObject\Page;
use Behat\Mink\Exception\DriverException;

class CommonActions extends Page {


    public function click($locator){
        try{
            $element = $this->find('xpath',$locator);
//            while ($element == NULL){
//                var_export('try this');
//                $url = $this->getUrl(['/']);
//                var_export($url);
//                break;

//            }
            $element->click();
        }
        catch (\WebDriver\Exception\Timeout $e){

        }

    }

    public function isVisible($locator){

        if($this->find('xpath',$locator)){
            $visible = $this->find('xpath',$locator)->isVisible();
        }else{
            $visible = false;
        }
        return $visible;
    }

    public function openPage($urlParameters){
        try{
            $url = $this->getUrl([$urlParameters]);
            $this->getDriver()->visit($url.$urlParameters);
        }
        catch (\WebDriver\Exception\Timeout $e){
//            var_export('in catch of method: openPage::Common Actions');
        }
    }

    public function getBaseUrl($urlParameters){

        try{
            $url = $this->getUrl([$urlParameters]);
        }
        catch (\WebDriver\Exception\Timeout $e){
        }
        return $url;
    }

    public function getCurrentUrl(){
        try{
            $url = $this->getDriver()->getCurrentUrl();
        }
        catch (\WebDriver\Exception\Timeout $e){
        }
        return $url;
    }

    public function setPageTimeOut(){
//        var_export($this->getSession()->getDriver());
        $this->getSession()->getDriver()->setTimeouts(['page load'=>5000]);
//        var_export('in here');
    }

    public function getFieldText($locator){
        try{
            $text = $this->find('xpath',$locator)->getText();
        }
        catch (\WebDriver\Exception\Timeout $e){
        }
        return $text;
    }

    public function waitForTime($seconds){
        try{
            $this->getDriver()->wait($seconds,1==2);
        }
        catch (\WebDriver\Exception\Timeout $e){
        }

    }

    public function getSelectedTextFromDropdown($locator){
        try{
            $locator = $locator.'/option[@selected]';
            $selectedText = $this->find('xpath',$locator)->getText();
        }
        catch (\WebDriver\Exception\Timeout $e){
        }
        return $selectedText;
    }

    public function selectDropdownOptionByText($locator,$option){
        try{
            $this->find('xpath',$locator)->selectOption($option);
        }
        catch (\WebDriver\Exception\Timeout $e){
        }
    }


    public function type($locator,$text){
        try{
            $this->find('xpath',$locator)->setValue($text);
        }
        catch (\WebDriver\Exception\Timeout $e){
        }
    }
}
