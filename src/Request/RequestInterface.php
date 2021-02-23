<?php

namespace DeliveryCalculator\Request;

interface RequestInterface
{

    /**
     * Return sender address
     *
     * @return string
     */
    public function getSenderAddress(): string;

    /**
     * Return receiver address
     *
     * @return string
     */
    public function getReceiverAddress(): string;

    /**
     * Return all request items
     *
     * @return RequestItemInterface[]
     */
    public function getItems(): array;

}