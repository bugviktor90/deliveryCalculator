<?php


namespace DeliveryCalculator\Result;

use DateTime;

/**
 * Delivery calculator result item
 *
 * @package DeliveryCalculator
 */
class ResultItem implements ResultItemInterface
{
    /**
     * Calculated delivery cost
     *
     * @var float
     */
    protected float $cost;

    /**
     * Calculated delivery date
     *
     * @var DateTime
     */
    protected DateTime $date;

    /**
     * @inheritdoc
     */
    public function setCost(float $cost): void
    {
        $this->cost = $cost;
    }

    /**
     * @inheritdoc
     */
    public function setDate(DateTime $date): void
    {
        $this->date = $date;
    }

    /**
     * @inheritdoc
     */
    public function getCost(): float
    {
        return $this->cost;
    }

    /**
     * @inheritdoc
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }
}