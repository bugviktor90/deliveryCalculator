<?php

namespace DeliveryCalculator\Request;

trait RequestSummary
{
    /**
     * Return request summary volume
     * @return float
     */
    public function getSummaryVolume(): float
    {
        return array_sum(array_map(function (RequestItemInterface $item) {
            return $item->getVolume();
        }, $this->getItems()));
    }

    /**
     * Return request summary weight
     *
     * @return float
     */
    public function getSummaryWeight(): float
    {
        return array_sum(array_map(function (RequestItemInterface $item) {
            return $item->getWeight();
        }, $this->getItems()));
    }
}