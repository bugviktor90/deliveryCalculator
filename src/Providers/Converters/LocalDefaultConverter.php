<?php


namespace DeliveryCalculator\Providers\Converters;

use DeliveryCalculator\Result\ResultItemInterface;

class LocalDefaultConverter implements Converter
{
    /**
     * @inheritdoc
     */
    public function convert(mixed $data, ResultItemInterface $result): ResultItemInterface
    {
        $result->setCost($data['cost']);
        $result->setDate($data['date']);

        return $result;
    }

}