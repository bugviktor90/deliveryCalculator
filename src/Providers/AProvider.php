<?php


namespace DeliveryCalculator\Providers;


use DeliveryCalculator\Providers\Converters\ADefaultConverter;
use DeliveryCalculator\Request\RequestInterface;
use GuzzleHttp\Client;

class AProvider extends Provider
{

    /**
     * GuzzleHttp client
     * @var Client
     */
    protected Client $client;

    /**
     * Base API url
     *
     * @var string
     */
    protected string $url = '';

    /**
     * API access key
     *
     * @var string
     */
    protected string $accessKey = '';

    /**
     * API client ID
     *
     * @var string
     */
    protected string $clientId = '';

    /**
     * @inheritdoc
     */
    public function __construct($config = [])
    {
        $this->converter = new ADefaultConverter();
        $this->url = $config['url'] ?? $this->url;
        $this->accessKey = $config['accessKey'] ?? $this->accessKey;
        $this->clientId = $config['clientId'] ?? $this->clientId;

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
//        $response = $this->client->get('delivery_info', [
//            'query' => [
//                'access_key' => $this->accessKey,
//                'client_id' => $this->clientId,
//            ],
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
            'cost' => 850,
            'daysCount' => 10
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
                'size' => $item->getVolume()
            ];
        }

        return json_encode($body);
    }

}