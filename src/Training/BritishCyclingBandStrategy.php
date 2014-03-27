<?php
namespace Training;

class BritishCyclingBandStrategy implements BandStrategy
{

    private $bands;
    
    public function __construct()
    {
        $this->bands = array(
            array(0, 68),
            array(68, 83),
            array(83, 94),
            array(94, 105),
            array(105, 121),
        );
    }
    
    /**
     *  Calculate a list of Zone instances based on a given heart rate
     *  For the British Cycling method, this heart rate is seen as the Functional Threshold Heart Rate
     *  See: http://www.britishcycling.org.uk/insightzone/physical_preparation/planning_for_performance/article/izn20130107-Sportive-Dont-Miss-a-Beat-a%C2%80%C2%93-Your-Guide-to-Heart-Rate-Monitors-0
     *
     * @param float $bpm The bpm heart rate to use
     * @return array a list of Zone instances
     */
    public function calculateZones($bpm)
    {
        $zones = array();

        foreach ($this->bands as $band)
        {
            $zones[] = HeartRate::getZone($bpm, $band[0], $band[1]);
        }
        
        return $zones;
    }

}