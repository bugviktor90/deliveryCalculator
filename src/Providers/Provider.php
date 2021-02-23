<?php


namespace DeliveryCalculator\Providers;


use DeliveryCalculator\Providers\Converters\Converter;
use DeliveryCalculator\Request\RequestInterface;
use DeliveryCalculator\Result\ResultItemInterface;

abstract class Provider
{
    /**
     * Linked converter
     *
     * @var Converter
     */
    protected Converter $converter;

    /**
     * Delivery calculator provider constructor
     *
     * @param array $config params for provider's configuration
     */
    abstract public function __construct($config = []);

    /**
     * Return provider's result
     *
     * @param RequestInterface $request
     * @return ResultItemInterface
     */
    abstract public function process(RequestInterface $request): mixed;


    /**
     * Return linked converter
     *
     * @return Converter
     */
    public function getConverter(): Converter
    {
        return $this->converter;
    }

    /**
     * Set data converter
     *
     * @param Converter $converter
     */
    public function setConverter(Converter $converter): void
    {
        $this->converter = $converter;
    }

}