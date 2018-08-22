<?php

/**
 * Created by PhpStorm.
 * User: sadla
 * Date: 5/30/18
 * Time: 12:02 PM
 */


namespace Pages;

use Behat\MinkExtension\Context\RawMinkContext;
use SensioLabs\Behat\PageObjectExtension\PageObject\Page;
use Behat\Mink\Exception\DriverException;

class CommonActions extends Page {


    public function click($locator){
        try{
            $this->find('xpath',$locator)->click();
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
            if(strpos($urlParameters,'http') !== false){
                $this->getDriver()->visit($urlParameters);
            }else {
                $url = $this->getUrl([$urlParameters]);
                $this->getDriver()->visit($url.$urlParameters);
            }

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
        $this->getSession()->getDriver()->setTimeouts(['page load'=>5000]);
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

    public function takeScreenShot(){
        try{
           return $this->getDriver()->getScreenshot();
        }
        catch (\WebDriver\Exception\Timeout $e){
        }
    }
    public function getWindows(){
        try{
            return $this->getDriver()->getWindowNames();
        }
        catch (\WebDriver\Exception\Timeout $e){
        }
    }
    public function switchWindow($windowname){
        try{
            return $this->getDriver()->switchToWindow($windowname);
        }
        catch (\WebDriver\Exception\Timeout $e){
        }
    }
}
