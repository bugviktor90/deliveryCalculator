<?php


namespace DeliveryCalculator\Providers;

use DateTime;
use DeliveryCalculator\Providers\Converters\LocalDefaultConverter;
use DeliveryCalculator\Request\RequestInterface;
use DeliveryCalculator\Request\RequestSummaryInterface;

class LocalProvider extends Provider
{
    /**
     * Volume rate for 1m^3
     *
     * @var float
     */
    protected float $volumeRate = 3000;

    /**
     * Weight rate for 1kg
     *
     * @var float
     */
    protected float $weightRate = 4.5;


    /**
     * @inheritdoc
     */
    public function __construct($config = [])
    {
        $this->converter = new LocalDefaultConverter();
        if (isset($config['volumeRate']) && is_numeric($config['volumeRate'])) {
            $this->volumeRate = $config['volumeRate'];
        }

        if (isset($config['weightRate']) && is_numeric($config['weightRate'])) {
            $this->weightRate = $config['weightRate'];
        }
    }

    /**
     * @inheritdoc
     */
    public function process(RequestInterface $request): array
    {
        return [
            'date' => new DateTime('+3day'),
            'cost' => $this->getCost($request)
        ];
    }

    /**
     * Return delivery cost
     *
     * @param RequestSummaryInterface $request
     * @return float
     */
    protected function getCost(RequestSummaryInterface $request): float
    {
        return max(
            $request->getSummaryVolume() * $this->volumeRate,
            $request->getSummaryWeight() * $this->weightRate
        );
    }

}