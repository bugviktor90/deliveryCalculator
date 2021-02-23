<?php


namespace DeliveryCalculator\Request;


class RequestItem implements RequestItemInterface
{
    /**
     * Item width, mm
     *
     * @var int
     */
    protected int $width;

    /**
     * Item length, mm
     *
     * @var int
     */
    protected int $length;

    /**
     * Item height, mm
     *
     * @var int
     */
    protected int $height;

    /**
     * Item weight, kg
     *
     * @var float
     */
    protected float $weight;

    /**
     * Items quantity
     *
     * @var int
     */
    protected int $quantity;

    /**
     * Delivery request item constructor
     *
     * @param int $width
     * @param int $length
     * @param int $height
     * @param float $weight
     * @param int $quantity
     */
    public function __construct(int $width, int $length, int $height, float $weight, int $quantity = 1)
    {
        $this->width = $width;
        $this->length = $length;
        $this->height = $height;
        $this->weight = $weight;
        $this->quantity = $quantity;
    }

    /**
     * @inheritdoc
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @inheritdoc
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * @inheritdoc
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @inheritdoc
     */
    public function getWeight(): float
    {
        return $this->weight;
    }

    /**
     * @inheritdoc
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @inheritdoc
     */
    public function getVolume(): float
    {
        return $this->width * $this->length * $this->height / 1000000000;
    }
}