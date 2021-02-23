<?php

namespace DeliveryCalculator\Request;

interface RequestItemInterface
{
    /**
     * Return width, mm
     *
     * @return int
     */
    public function getWidth(): int;

    /**
     * Return length, mm
     *
     * @return int
     */
    public function getLength(): int;

    /**
     * Return height, mm
     *
     * @return int
     */
    public function getHeight(): int;

    /**
     * Return weight
     *
     * @return float
     */
    public function getWeight(): float;

    /**
     * Return items quantity
     *
     * @return int
     */
    public function getQuantity(): int;

    /**
     * Return item volume, m^3
     *
     * @return float
     */
    public function getVolume(): float;
}