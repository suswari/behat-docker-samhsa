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

class CommonPageElements extends CommonActions {

    //##############################################################################
    //#######################      Page elements Xpath      ########################
    //##############################################################################

    public function HelperBlocksImages($imageName = null){
        if(!$imageName){
            return './/*[@class="l-region l-region--sidebar-second"]//img[@alt] ]';
        }else{
            return './/*[@class="l-region l-region--sidebar-second"]//img[@alt="'.$imageName.'"]';
        }
    }
    public function HelperBlockerPhoneNumberText($imageName = null){
        if(!$imageName){
            return './/*[@class="l-region l-region--sidebar-second"]//img[@alt]/../../p';
        }else{
            return './/*[@class="l-region l-region--sidebar-second"]//img[@alt="'.$imageName.'"]/../../p';
        }
    }

    public function PaginationLinks($number=null){
        if(!$number){
            return './/ul[@class="pager"]';
        }else{
            return './/ul[@class="pager"]/li/a[contains(text(),"'.$number.'")]';
        }
    }

    public $SAMHSAFooter = './/div[@class="l-region l-region--footer"]';
    public $SAMHSABottomFooter = './/div[@class="l-region l-region--bottom-footer"]';

    public function DropdownLabels($labelname){
        return './/label[normalize-space(text())="'.$labelname.'"]';
    }

    public function DropdownField($labelname){
        if($this->find('xpath','.//label[(normalize-space(text())="'.$labelname.'")]/following-sibling::*//select')){
            return './/label[(normalize-space(text())="'.$labelname.'")]/following-sibling::*//select';
        }else{
            return './/label[(normalize-space(text())="'.$labelname.'")]/following-sibling::select';
        }
    }
    public function DropdownOptions($labelname){
        if($this->find('xpath','.//label[(normalize-space(text())="'.$labelname.'")]/following-sibling::*//select')){
            return './/label[(normalize-space(text())="'.$labelname.'")]/following-sibling::*//select/option';
        }else{
            return './/label[(normalize-space(text())="'.$labelname.'")]/following-sibling::select/option';
        }

    }


    public $ApplyButton = './/input[@value="Apply"]';


    //##############################################################################
    //#######################      Page methods             ########################
    //##############################################################################





}