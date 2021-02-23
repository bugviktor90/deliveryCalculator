<?php


namespace DeliveryCalculator\Result;

use DateTime;
use DeliveryCalculator\Providers\Provider;

class Result
{
    /**
     * Calculation result items
     *
     * @var ResultItemInterface[]
     */
    protected array $items = [];

    /**
     * Add result item
     *
     * @param ResultItemInterface $item
     * @param Provider $provider
     */
    public function addItem(ResultItemInterface $item, Provider $provider): void
    {
        $this->items[get_class($provider)] = $item;
    }

    /**
     * Return calculation result items
     *
     * @return ResultItemInterface[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * Return delivery minimal cost
     *
     * @return float
     */
    public function getMinCost(): float
    {
        $costs = array_map(function (ResultItemInterface $item) {
            return $item->getCost();
        }, $this->getItems());

        return $costs ? min($costs) : 0;
    }

    /**
     * Return delivery minimal date
     *
     * @return DateTime|null
     */
    public function getMinDate(): ?DateTime
    {
        $minDate = null;
        foreach ($this->getItems() as $item) {
            if (is_null($minDate) || $minDate > $item->getDate()) {
                $minDate = $item->getDate();
            }
        }

        return $minDate;
    }
}