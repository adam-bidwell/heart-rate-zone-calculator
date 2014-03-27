<?php
namespace Training;

class ZoneTest extends \PHPUnit_Framework_TestCase
{

    public function testSetUpperHigherThanLower()
    {
        $zone = new Zone(101, 120);
        $this->assertGreaterThan($zone->getLower(), $zone->getUpper());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testConstructUpperLessThanLower()
    {
        $zone = new Zone(121, 119);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSetUpperLessThanLower()
    {
        $zone = new Zone(119, 121);
        $zone->setUpper(118);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSetLowerGreaterThanUpper()
    {
        $zone = new Zone(119, 121);
        $zone->setLower(123);
    }

    public function testConstructWithBoundaries()
    {
        $zone = new Zone(101, 121);
        $this->assertInstanceOf('Training\Zone', $zone);
        $this->assertEquals(101, $zone->getLower());
        $this->assertEquals(121, $zone->getUpper());
    }
    
    public function testSetGetLowerBoundary()
    {
        $zone = new Zone(101, 102);
        $this->assertEquals(101, $zone->getLower());
    }

    public function testSetGetUpperBoundary()
    {
        $zone = new Zone(101, 102);
        $this->assertEquals(102, $zone->getUpper());
    }
    
    public function testSetGetLabel()
    {
        $zone = new Zone(101, 102);
        $zone->setLabel("Test");
        $this->assertEquals("Test", $zone->getLabel());
    }

}