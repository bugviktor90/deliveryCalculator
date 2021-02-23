<?php


namespace DeliveryCalculator\Providers;


use DeliveryCalculator\Providers\Converters\BDefaultConverter;
use DeliveryCalculator\Request\RequestInterface;
use GuzzleHttp\Client;

class BProvider extends Provider
{
    /**
     * GuzzleHttp client
     *
     * @var Client
     */
    protected Client $client;

    /**
     * API url
     *
     * @var string
     */
    protected string $url = '';

    /**
     * @inheritdoc
     */
    public function __construct($config = [])
    {
        $this->converter = new BDefaultConverter();
        $this->url = $config['url'] ?? $this->url;

//        //here may be provider connection config
//        $this->client = new Client([
//            'base_uri' => $this->url,
//            'timeout' => 30
//        ]);
    }

    /**
     * @inheritdoc
     */
    public function process(RequestInterface $request): array
    {
//        //here may be request to provider's API
//        $response = $this->client->get('calculate_delivery', [
//            'body' => $this->getRequestBody($request)
//        ]);
//
//        $responseData = [];
//        if ($response->getStatusCode() == 200) {
//            $response = $response->getBody()->getContents();
//            $responseData = json_decode($response, true);
//        }

        //this data for test
        return [
            'baseCost' => 100,
            'rate' => 14,
            'date' => '10.03.2021'
        ];
    }

    /**
     * Return request body
     *
     * @param RequestInterface $request
     * @return string
     */
    protected function getRequestBody(RequestInterface $request): string
    {
        $body = [
            'sender' => $request->getSenderAddress(),
            'receiver' => $request->getReceiverAddress(),
            'items' => []
        ];

        foreach ($request->getItems() as $item) {
            $body['items'][] = [
                'weight' => $item->getWeight(),
                'volume' => $item->getVolume(),
                'count' => $item->getQuantity()
            ];
        }

        return json_encode($body);
    }
}