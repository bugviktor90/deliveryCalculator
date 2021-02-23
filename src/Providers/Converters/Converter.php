<?php

namespace DeliveryCalculator\Providers\Converters;

use DeliveryCalculator\Result\ResultItemInterface;

interface Converter
{
    /**
     * Convert data from provider to ResultItemInterface
     *
     * @param mixed $data
     * @param ResultItemInterface $result
     * @return ResultItemInterface
     */
    public function convert(mixed $data, ResultItemInterface $result): ResultItemInterface;
}