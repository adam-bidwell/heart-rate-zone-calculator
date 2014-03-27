<?php
namespace Training;

class Zone
{

    private $lower;
    private $upper;
    private $label;
    
    
    /**
     *  Create the Zone instance. Storing a lower and upper heart rate for this band
     *
     * @param float $lower heart rate
     * @param float $upper heart rate
     */
    public function __construct($lower, $upper)
    {
        $this->setUpper($upper);
        $this->setLower($lower);
    }
    
    /**
     *  Set the lower heart rate value for this zone
     *
     * @param float $lower
     * @throws InvalidArgumentException if lower is greater than the current upper value
     */
    public function setLower($lower)
    {
        if ($lower > $this->getUpper()) throw new \InvalidArgumentException('The lower heart rate cannot be greater than the upper heart rate');

        $this->lower = $lower;
    }
    
    /**
     *  Get the the lower heart rate value for this zone
     *
     * @return float Heart rate value
     */
    public function getLower()
    {
        return $this->lower;
    }

    /**
     *  Set the upper heart rate value for this zone
     *
     * @param float $upper
     * @throws InvalidArgumentException if upper is less than the current lower value
     */
    public function setUpper($upper)
    {
        if ($upper < $this->getLower()) throw new \InvalidArgumentException('The upper heart rate cannot be less than the lower heart rate');

        $this->upper = $upper;
    }
    
    /**
     *  Get the the upper heart rate value for this zone
     *
     * @return float Heart rate value
     */
    public function getUpper()
    {
        return $this->upper;
    }

    /**
     *  Set the textual description (label) for this heart rate zone
     *
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }
    
    /**
     *  Get the the textual description for this heart rate zone
     *
     * @return string Zone label
     */
    public function getLabel()
    {
        return $this->label;
    }

}