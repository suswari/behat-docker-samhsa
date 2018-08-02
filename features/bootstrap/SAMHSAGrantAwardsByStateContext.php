<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Pages\CommonPageElements;
use Pages\SAMSHAHomePage;
use Pages\ProgramAndCampaignsPage;
use Pages\GrantAwardsByStatePage;

/**
 * Defines application features from the specific context.
 */
class SAMHSAGrantAwardsByStateContext extends PHPUnit_Framework_TestCase implements Context
{
    public $HomePage;
    public $GrantAwardsByStatePage;
    public $CommonPageElements;
    public $ProgramsAndCampaignsPage;

    public function __construct(SAMSHAHomePage $HomePage, GrantAwardsByStatePage $GrantAwardsByStatePage,CommonPageElements $CommonPageElements, ProgramAndCampaignsPage $ProgramsAndCampaignsPage)
    {
        $this->HomePage = $HomePage;
        $this->GrantAwardsByStatePage = $GrantAwardsByStatePage;
        $this->CommonPageElements = $CommonPageElements;
        $this->ProgramsAndCampaignsPage = $ProgramsAndCampaignsPage;

    }


    /**
     * @When /^The user views the grant awards for the following fiscal year and state$/
     */
    public function ClickFiscalYearAndState(TableNode $table)
    {
        $hash = $table->getHash();
        foreach ($hash as $row) {
            $this->GrantAwardsByStatePage->click($this->GrantAwardsByStatePage->fiscalYearsLink($row['fiscal year']));
            $this->GrantAwardsByStatePage->click($this->GrantAwardsByStatePage->USAStates($row['state']));
        }
    }

    /**
     * @When /^The Grants summary page for the following state and year is seen$/
     */
    public function VerifyGrantSummaryPageHeader(TableNode $table)
    {
        $hash = $table->getHash();
        foreach ($hash as $row) {
            $stateheader = $this->GrantAwardsByStatePage->isVisible('.//h1[starts-with(text(),"'.strtoupper($row['state']).' ")]');
            $yearheader = $this->GrantAwardsByStatePage->isVisible('.//h1[text()[2]=" Summaries FY '.$row['fiscal year'].'"]');
            $this->assertTrue($stateheader,$row['state'].' header is not seen');
            $this->assertTrue($yearheader,'Summaries FY '.$row['fiscal year'].' header is not seen');

        }
    }

    /**
     * @When /^There are Grants summary blocks for "(?P<block1>(?:[^"]|\\")*)", "(?P<block2>(?:[^"]|\\")*)", "(?P<block3>(?:[^"]|\\")*)"$/
     */
    public function VerifyGrantSummaryBlocks($block1,$block2,$block3)
    {
        $blocksPresent = $this->GrantAwardsByStatePage->isVisible($this->GrantAwardsByStatePage->grantSummaryBlock($block1));
        $this->assertTrue($blocksPresent,'Summary block for '.$block1.' is not seen');
        $blocksPresent = $this->GrantAwardsByStatePage->isVisible($this->GrantAwardsByStatePage->grantSummaryBlock($block2));
        $this->assertTrue($blocksPresent,'Summary block for '.$block2.' is not seen');
        $blocksPresent = $this->GrantAwardsByStatePage->isVisible($this->GrantAwardsByStatePage->grantSummaryBlock($block3));
        $this->assertTrue($blocksPresent,'Summary block for '.$block3.' is not seen');
    }

    /**
     * @When /^From the summary page the user views Discretionary Funds in Detail$/
     */
    public function ClickDiscretionaryFundsinDetail()
    {
        $this->GrantAwardsByStatePage->click($this->GrantAwardsByStatePage->discretionaryFundsLink);
    }

    /**
     * @When /^From the summary page the user views Non-Discretionary Funds in Detail$/
     */
    public function ClickNonDiscretionaryFundsinDetail()
    {
        $this->GrantAwardsByStatePage->click($this->GrantAwardsByStatePage->nonDiscretionaryFundsLink);
    }

    /**
     * @When /^The Grants Discretionary Funds page for the following state and year is seen$/
     */
    public function VerifyGrantDiscretionaryFundsPageHeader(TableNode $table)
    {
        $hash = $table->getHash();
        foreach ($hash as $row) {
            $stateheader = $this->GrantAwardsByStatePage->isVisible('.//h1[starts-with(text(),"'.strtoupper($row['state']).' ")]');
            $yearheader = $this->GrantAwardsByStatePage->isVisible('.//h1[text()[2]=" Fiscal Year '.$row['fiscal year'].' Discretionary Funds"]');
            $this->assertTrue($stateheader,$row['state'].' header is not seen');
            $this->assertTrue($yearheader,'Fiscal Year '.$row['fiscal year'].' Discretionary Funds header is not seen');
        }
    }

    /**
     * @When /^The Grants Non-Discretionary Funds page for the following state and year is seen$/
     */
    public function VerifyGrantNonDiscretionaryFundsPageHeader(TableNode $table)
    {
        $hash = $table->getHash();
        foreach ($hash as $row) {
            $stateheader = $this->GrantAwardsByStatePage->isVisible('.//h1[starts-with(text(),"'.strtoupper($row['state']).' ")]');
            $yearheader = $this->GrantAwardsByStatePage->isVisible('.//h1[text()[2]=" Fiscal Year '.$row['fiscal year'].' Non-Discretionary Funds"]');
            $this->assertTrue($stateheader,$row['state'].' header is not seen');
            $this->assertTrue($yearheader,'Fiscal Year '.$row['fiscal year'].' Non-Discretionary Funds header is not seen');
        }
    }

    /**
     * @When /^There are Grants details blocks$/
     */
    public function VerifyGrantDetailsBlocks()
    {

            $blocks = $this->GrantAwardsByStatePage->findAll('xpath',$this->GrantAwardsByStatePage->grantsDetailsBlocks);
            $length = count($blocks);
            $this->assertNotEquals($length,0,'There are no details');


    }
}


