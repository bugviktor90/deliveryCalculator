<?php


namespace DeliveryCalculator\Providers\Converters;


use DateTime;
use DeliveryCalculator\Result\ResultItemInterface;

class ADefaultConverter implements Converter
{
    /**
     * @inheritdoc
     */
    public function convert(mixed $data, ResultItemInterface $result): ResultItemInterface
    {
        $result->setCost($data['cost']);
        $result->setDate(new DateTime('+' . $data['daysCount'] . 'days'));

        return $result;
    }

}