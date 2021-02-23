<?php

namespace DeliveryCalculator\Request;

interface RequestSummaryInterface
{
    /**
     * Return request summary volume
     *
     * @return float
     */
    public function getSummaryVolume(): float;

    /**
     * Return request summary weight
     *
     * @return float
     */
    public function getSummaryWeight(): float;
}