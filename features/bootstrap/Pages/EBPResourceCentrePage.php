<?php
/**
 * Created by PhpStorm.
 * User: sadla
 * Date: 5/30/18
 * Time: 12:02 PM
 */


namespace Pages;

use Behat\Mink\Session;
use SensioLabs\Behat\PageObjectExtension\PageObject\Factory;

class EBPResourceCentrePage extends CommonActions {
    public function __construct(Session $session, Factory $factory, array $parameters = array())
    {
        parent::__construct($session, $factory, $parameters);
        $this->setPageTimeOut();
    }
    protected $path = '/ebp-resource-center';
    public $EBPBanner = './/span[@id="banner"]/img';
    public $EBPTitle = './/h1[text()="Evidence-Based Practices Resource Center"]';
    public $EBPWelcomeStatement = './/div[@class="node__content"]';
    public $filterResourcesSubHeading = './/h2[text()="Resources"]';
    public $EBPRelatedDocumentsBlock = './/div[@class="view-content"]';
    public $EBPTechnicalAssistanceBlock = './/div[@id="node-233401"]';
    public $TopicAreaFilterLabel = './/div[@id=\'edit-field-evp-section-page-value-wrapper\']/label[contains(text(),\'Topic Area\')]';
    public $PopulationFilterLabel = './/div[@id=\'edit-field-ebp-population-tid-wrapper\']/label[contains(text(),\'Populations\')]';
    public $TargetAudienceFilterLabel = './/div[@id=\'edit-field-ebp-audience-tid-wrapper\']/label[contains(text(),\'Target Audience\')]';
    public $ResourceTypeFilterLabel = './/div[@id=\'edit-field-ebp-resource-type-tid-wrapper\']/label[contains(text(),\'Resource Type\')]';
    public $TopicAreaFilterDropdown = './/select[@id=\'edit-field-evp-section-page-value\']';
    public $PopulationFilterDropdown = './/select[@id=\'edit-field-ebp-population-tid\']';
    public $TargetAudienceFilterDropdown = './/select[@id=\'edit-field-ebp-audience-tid\']';
    public $ResourceTypeFilterDropdown = './/select[@id=\'edit-field-ebp-resource-type-tid\']';
    public $ApplyButton = './/input[@value="Apply"]';
    public $SortByFilterLabel = './/select[@id="edit-sort-bef-combine"]/preceding-sibling::label[contains(text(),"Sort by")]';
    public $SortByFilterDropdown = './/select[@id="edit-sort-bef-combine"]';
    public $ItemsPerPageFilterLabel = './/select[@id="edit-items-per-page"]/preceding-sibling::label[contains(text(),"Items per page")]';
    public $ItemsPerPageFilterDropdown = './/select[@id="edit-items-per-page"]';
    public function ResourcesLinks ($linkName = null){
        if(!$linkName){
            return './/div[@class="views-field views-field-title resource_list_link"]/span/a';
        }else{
            return './/div[@class="views-field views-field-title resource_list_link"]/span/a[text()="'.$linkName.'"]';
        }
    }
    public $ResourceDescription = './/div[@class="views-field views-field-body resource_list_description"]/div/p';
    public $TopicAreaResourceTag = './/div[@class="views-field views-field-field-evp-section-page resource_list_term"]/span[text()="Topic Area: "]';
    public $PopulationResourceTag = './/div[@class="views-field views-field-field-ebp-population resource_list_term"]/span[text()="Populations: "]';
    public $TargetAudienceResourceTag = './/div[@class="views-field views-field-field-ebp-audience resource_list_term"]/span[text()="Target Audience: "]';
    public $ResourceTypeResourceTag = './/div[@class="views-field views-field-field-ebp-resource-type resource_list_term"]/span[text()="Resource Type: "]';
    public $SubstanceResourceTag = './/div[@class="views-field views-field-field-ebp-substances resource_list_term"]/span[text()="Substances: "]';
    public $ConditionResourceTag = './/div[@class="views-field views-field-field-ebp-conditions resource_list_term"]/span[text()="Conditions: "]';
    public $SubstanceResourceTagValue = './/div[@class="views-field views-field-field-ebp-substances resource_list_term"]/div';
    public $ConditionResourceTagValue = './/div[@class="views-field views-field-field-ebp-conditions resource_list_term"]/div';
    public function TechnicalAssitanceLinks($linkname=null){
        if(!$linkname){
            return './/div[@id="node-233401"]//li/a';
        }else{
            return './/div[@id="node-233401"]//li/a[text()="'.$linkname.'"]';

        }
    }
    public function MoreTechnicalAssistanceLink($linkname=null){
        if(!$linkname){
            return './/div[@id="node-233401"]//p/a';
        }else{
            return './/div[@id="node-233401"]//p/a[text()="'.$linkname.'"]';

        }
    }



    public function GetResourcesLinksCount(){
        $AllResources = $this->findAll('xpath',$this->ResourcesLinks());
        return count($AllResources);
    }

    public function GetAllResourcesLinkText(){
        $AllResources = $this->findAll('xpath',$this->ResourcesLinks());
        $AllLinkText = array();
        foreach ($AllResources as $resource) {
            $linkText = $resource->getText();
            array_push($AllLinkText,$linkText);
        }
        return $AllLinkText;
    }

    public function GetAllResourcesDescription(){
        $AllResources = $this->findAll('xpath',$this->ResourceDescription);
        $AllLinkText = array();
        foreach ($AllResources as $resource) {
            $linkText = $resource->getText();
            if ($linkText != null){
                array_push($AllLinkText,$linkText);
            }
        }
        return $AllLinkText;
    }

    public function GetSubstanceResourceTags(){
        $AllSubstanceResourceTags = $this->findAll('xpath',$this->SubstanceResourceTag);
        return $AllSubstanceResourceTags;
    }
    public function GetConditionsResourceTags(){
        $AllSubstanceResourceTags = $this->findAll('xpath',$this->ConditionResourceTag);
        return $AllSubstanceResourceTags;
    }
    public function GetSubstanceResourceTagsValue(){
        $AllSubstanceResourceTags = $this->findAll('xpath',$this->SubstanceResourceTagValue);
//        foreach ($AllSubstanceResourceTags as $resource) {
//            $linkText = $resource->getText();
//            var_export($linkText);
//        }
        return $AllSubstanceResourceTags;
    }
    public function GetConditionsResourceTagsValue(){
        $AllSubstanceResourceTags = $this->findAll('xpath',$this->ConditionResourceTagValue);
        return $AllSubstanceResourceTags;
    }
}

