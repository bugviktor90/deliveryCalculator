<?php


namespace DeliveryCalculator;


use DeliveryCalculator\Providers\Provider;
use DeliveryCalculator\Request\RequestInterface;
use DeliveryCalculator\Result\Result;
use DeliveryCalculator\Result\ResultItem;
use DeliveryCalculator\Result\ResultItemInterface;

class Calculator
{
    /**
     * Delivery providers
     * @var Provider[]
     */
    protected array $providers = [];

    /**
     * Delivery calculator constructor
     *
     * @param Provider[] $providers
     */
    public function __construct(array $providers = [])
    {
        $this->setProviders($providers);
    }

    /**
     * Set providers
     *
     * @param array $providers
     */
    public function setProviders(array $providers = []): void
    {
        $this->providers = [];
        foreach ($providers as $provider) {
            $this->addProvider($provider);
        }
    }

    /**
     * Add delivery provider for calculate
     *
     * @param Provider $provider
     * @return bool
     */
    public function addProvider(Provider $provider): bool
    {
        if (!isset($this->providers[get_class($provider)])) {
            $this->providers[get_class($provider)] = $provider;
            return true;
        }

        return false;
    }

    /**
     * Remove provider from calculator
     *
     * @param Provider $provider
     * @return bool
     */
    public function removeProvider(Provider $provider): bool
    {
        if (isset($this->providers[get_class($provider)])) {
            unset($this->providers[get_class($provider)]);
            return true;
        }

        return false;
    }

    /**
     * Calculate delivery for all providers
     *
     * @param RequestInterface $request
     * @return Result
     */
    public function calculateAll(RequestInterface $request): Result
    {
        $result = new Result();
        foreach ($this->providers as $provider) {
            $result->addItem(
                $this->getProviderData($request, $provider),
                $provider
            );
        }

        return $result;
    }

    /**
     * Calculate delivery for one provider
     *
     * @param RequestInterface $request
     * @param Provider $provider
     * @return Result
     */
    public function calculate(RequestInterface $request, Provider $provider): Result
    {
        $result = new Result();
        $result->addItem(
            $this->getProviderData($request, $provider),
            $provider
        );

        return $result;
    }

    /**
     * Get data from provider in ResultItemInterface format
     * @param RequestInterface $request
     * @param Provider $provider
     * @return ResultItemInterface
     */
    protected function getProviderData(RequestInterface $request, Provider $provider): ResultItemInterface
    {
        $resultItem = new ResultItem();
        $providerData = $provider->process($request);
        $converter = $provider->getConverter();

        return $converter->convert($providerData, $resultItem);
    }

}