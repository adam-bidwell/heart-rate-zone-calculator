<?php
namespace Training;

class BritishCyclingBandStrategyTest extends \PHPUnit_Framework_TestCase
{

    public function testConstruct()
    {
        $bc_bands = new BritishCyclingBandStrategy();
        $this->assertInstanceOf('Training\BritishCyclingBandStrategy', $bc_bands);
    }

    public function testBCBands()
    {
        $bc_bands = new BritishCyclingBandStrategy();
        $fthr = new HeartRate(100);
        $fthr->setBandStrategy($bc_bands);
        $zones = $fthr->getZones();
        
        $this->assertCount(5, $zones);
        
        $expected = array(
            array(0, 68),
            array(68, 83),
            array(83, 94),
            array(94, 105),
            array(105, 121),
        );

        foreach ($zones as $i => $zone)
        {
            $l = $expected[$i][0];
            $u = $expected[$i][1];

            $this->assertEquals($l, $zone->getLower());
            $this->assertEquals($u, $zone->getUpper());
        }
    }
}