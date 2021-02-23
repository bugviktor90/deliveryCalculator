<?php


namespace DeliveryCalculator\Providers\Converters;


use DateTime;
use DeliveryCalculator\Result\ResultItemInterface;

class BDefaultConverter implements Converter
{
    /**
     * @inheritdoc
     */
    public function convert(mixed $data, ResultItemInterface $result): ResultItemInterface
    {
        $result->setCost($data['baseCost'] * $data['rate']);
        $result->setDate(new DateTime($data['date']));

        return $result;
    }

}