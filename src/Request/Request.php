<?php


namespace DeliveryCalculator\Request;

/**
 * Delivery request
 *
 * @package DeliveryCalculator
 */
class Request implements RequestInterface, RequestSummaryInterface
{
    use RequestSummary;

    /**
     * Sender address
     *
     * @var string
     */
    protected string $senderAddress;

    /**
     * Receiver address
     *
     * @var string
     */
    protected string $receiverAddress;

    /**
     * Items for request
     *
     * @var RequestItemInterface[]
     */
    protected array $items = [];

    /**
     * Delivery request constructor
     *
     * @param string $senderAddress
     * @param string $receiverAddress
     * @param RequestItemInterface[] $items
     */
    public function __construct(string $senderAddress, string $receiverAddress, array $items = [])
    {
        $this->senderAddress = $senderAddress;
        $this->receiverAddress = $receiverAddress;

        foreach ($items as $item) {
            $this->addItem($item);
        }
    }

    /**
     * Add delivery request item
     *
     * @param RequestItemInterface $item
     */
    public function addItem(RequestItemInterface $item): void
    {
        $this->items[] = $item;
    }

    /**
     * Return sender address
     *
     * @return string
     */
    public function getSenderAddress(): string
    {
        return $this->senderAddress;
    }

    /**
     * Return receiver address
     *
     * @return string
     */
    public function getReceiverAddress(): string
    {
        return $this->receiverAddress;
    }

    /**
     * Return all request items
     *
     * @return RequestItemInterface[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}