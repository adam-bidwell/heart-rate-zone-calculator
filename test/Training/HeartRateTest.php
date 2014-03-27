<?php
namespace Training;

class HeartRateTest extends \PHPUnit_Framework_TestCase
{

    /**
     *  @expectedException InvalidArgumentException
     */
    public function testConstructLowOutOfBoundsHeartRate()
    {
        $fthr = new HeartRate(-1);
    }

    /**
     *  @expectedException InvalidArgumentException
     */
    public function testConstructHighOutOfBoundsHeartRate()
    {
        $fthr = new HeartRate(301);
    }

    public function testConstructInBoundsHeartRate()
    {
        $fthr = new HeartRate(100);
        $this->assertInstanceOf('Training\HeartRate', $fthr);
        $fthr = new HeartRate(219);
        $this->assertInstanceOf('Training\HeartRate', $fthr);
    }

    public function testSetGetBPM()
    {
        $fthr = new HeartRate(110);
        for ($f = 160; $f < 210; $f ++)
        {
            $fthr->setBPM($f);
            $this->assertEquals($f, $fthr->getBPM());
        }
    }
    
    public function testCalculatePercentageHeartRate()
    {
        $percentage = 68;
        $hr = 110;
        $expected = 74.8;
        $this->assertEquals($expected, HeartRate::getHeartRateAtPercentage($hr, $percentage));

        $percentage = 83;
        $hr = 110;
        $expected = 91.3;
        $this->assertEquals($expected, HeartRate::getHeartRateAtPercentage($hr, $percentage));
    }
    
    public function testCalculatePercentageHeartRateZone()
    {
        $lowerPcnt = 68;
        $upperPcnt = 83;
        $hr = 110;
        
        $zone = HeartRate::getZone($hr, $lowerPcnt, $upperPcnt);
        $this->assertInstanceOf('Training\Zone', $zone);
        $this->assertEquals(74.8, $zone->getLower());
        $this->assertEquals(91.3, $zone->getUpper());
    }
    
    public function testSetGetBands()
    {
        $bc_bands = new BritishCyclingBandStrategy();
        $fthr = new HeartRate(110);
        $fthr->setBandStrategy($bc_bands);
        $this->assertInstanceOf('Training\BritishCyclingBandStrategy', $fthr->getBandStrategy());
    }

}