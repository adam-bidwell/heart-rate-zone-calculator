<?php
namespace Training;

class HeartRate
{

    private $bpm;
    private $band_strategy;

    
    /**
     *  Create the Heart Rate instance, and specify a starting beats per minute value
     *
     * @param float $bpm The heart rate value
     */
    public function __construct($bpm)
    {
        $this->setBPM($bpm);
    }

    /**
     *  Set the bpm heart rate value
     *
     * @param float $bpm
     * @throws InvalidArgumentException if the value $bpm is not between 0 and 300 inclusive
     */
    public function setBPM($bpm)
    {
        if ($bpm >= 0 && $bpm <= 300)
        {
            $this->bpm = $bpm;
        }
        else
        {
            throw new \InvalidArgumentException('The heart rate must be between 0 and 300');
        }
    }
    
    /**
     *  Get the beats per minute value
     *
     * @return float heart rate bpm value
     */
    public function getBPM()
    {
        return $this->bpm;
    }
    
    /**
     *  Get the BPM heart rate at a percentage of the beats per minute
     *
     * @param float $bpm the heart rate at beats per minute
     * @param float $percentage the percentage to use for this calculation
     * @return float the heart rate value at the given percentage of the current BPM
     */
    public static function getHeartRateAtPercentage($bpm, $percent)
    {
        return $bpm / 100 * $percent;
    }
    
    /**
     *  Get a heart rate zone given lower and upper percentages of BPM
     *
     * @param float $bpm the heart rate at beats per minute
     * @param float $lowerPcnt percentage of BPM
     * @param float $upperPcnt percentage of BPM
     * @return Training\Zone
     */
    public static function getZone($bpm, $lowerPcnt, $upperPcnt)
    {
        $lowerHR = self::getHeartRateAtPercentage($bpm, $lowerPcnt);
        $upperHR = self::getHeartRateAtPercentage($bpm, $upperPcnt);

        return new Zone($lowerHR, $upperHR);
    }
    
    /**
     *  Set the concrete strategy to use when calculating heart rate zones
     *
     * @param BandStrategy implementation of the Bands interface
     */
    public function setBandStrategy(BandStrategy $bands)
    {
        $this->band_strategy = $bands;
    }
    
    /**
     *  Get the concrete strategy for calculating heart rate zones
     *
     * @return BandStrategy
     */
    public function getBandStrategy()
    {
        return $this->band_strategy;
    }
    
    /**
     *  Calculate the zones based on this BPM
     *
     * @return array List of Zone instances
     */
    public function getZones()
    {
        return $this->band_strategy->calculateZones($this->getBPM());
    }
     
}