<?php

namespace DeliveryCalculator\Result;

use DateTime;

interface ResultItemInterface
{
    /**
     * Set calculated cost
     *
     * @param float $cost
     */
    public function setCost(float $cost): void;

    /**
     * Set calculated delivery date
     *
     * @param DateTime $date
     */
    public function setDate(DateTime $date): void;

    /**
     * Return calculated cost
     *
     * @return float
     */
    public function getCost(): float;

    /**
     * Return calculated delivery date
     *
     * @return DateTime
     */
    public function getDate(): DateTime;
}