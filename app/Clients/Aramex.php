<?php
declare(strict_types=1);


namespace App\Clients;

use App\Models\Task;
use Illuminate\Support\Facades\Http;

class Aramex
{
    private array $config = [];
    private Task $task;
    private string $url = 'https://ws.sbx.aramex.net/shippingapi.v2/shipping/service_1_0.svc/json/CreateShipments'; // TOOD: make function

    public function __construct(Task $task)
    {
        $this->config = $this->getConfig();
        $this->task = $task;
    }

    public function getHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }

    public function sendCreateShipmentsRequest()
    {

        return Http::timeout(600)->withHeaders($this->getHeaders())
            ->post($this->url, $this->getCreateShipmentsData())->json();
    }

    private function getCreateShipmentsData(): array
    {
        return [
            'Shipments' => [$this->getShipmentsData()],
            'ClientInfo' => $this->getClientInfoData(),
            'Transaction' => $this->getTransactionData(),
        ];
    }

    private function getShipmentsData(): array
    {
        return [
            'Reference1' => 'SQR NEO',
            'Reference2' => null,
            'Reference3' => null,
            'Shipper' => $this->getShipperData(),
            'Consignee' => $this->getConsigneeData(),
            'ThirdParty' => null,
//            'ShippingDateTime' => "/Date(".now()->timestamp.")/",
            'DueDate' => "/Date(" . now()->timestamp . ")/",
            'Comments' => null,
            'PickupLocation' => null,
            'OperationsInstructions' => null,
            'AccountingInstrcutions' => null,
            'Details' => $this->getShipperDetailsData(),
            'Attachments' => null,
            'ForeignHAWB' => null,
            'TransportType' => 0,
            'PickupGUID' => null,
            'Number' => null,
            'ScheduledDelivery' => null
        ];
    }

    private function getShipperData(): array
    {
        return [
            'Reference1' => 'SQR NEO',
            'Reference2' => null,
            'AccountNumber' => $this->config['AccountNumber'],
            'PartyAddress' => $this->getShipperPartyAddressData(),
            'Contact' => $this->getShipperContactData()
        ];
    }

    private function getConsigneeData(): array
    {
        return [
            'Reference1' => null,
            'Reference2' => null,
            'AccountNumber' => null,
            'PartyAddress' => $this->getConsigneePartyAddressData(),
            'Contact' => $this->getConsigneeContactData(),
        ];
    }

    private function getConsigneePartyAddressData(): array
    {
        return [
            'Line1' => "Test Consignee Address Line1",
            'Line2' => "Test Consignee Address Line2",
            'Line3' => "Test Consignee Address Line3",
            'City' => "Dubai",
            'StateOrProvinceCode' => "FU",
            'PostCode' => "",
            'CountryCode' => "AE",
            'Longitude' => 0,
            'Latitude' => 0,
            'BuildingNumber' => null,
            'BuildingName' => null,
            'Floor' => null,
            'Apartment' => null,
            'POBox' => null,
            'Description' => null
        ];
    }

    private function getConsigneeContactData(): array
    {
        return [
            'Department' => null,
            'PersonName' => "Test Consignee Name",
            'Title' => null,
            'CompanyName' => "Test Consignee/Company Name",
            'PhoneNumber1' => "048707766",
            'PhoneNumber1Ext' => "",
            'PhoneNumber2' => "",
            'PhoneNumber2Ext' => "",
            'FaxNumber' => null,
            'CellPhone' => "971556893100",
            'EmailAddress' => "tets@hotmail.com",
            'Type' => ""
        ];
    }

    private function getShipperContactData(): array
    {
        return [
            'Department' => null,
            'PersonName' => 'SQR Card',
            'Title' => null,
            'CompanyName' => 'SQR Card',
            'PhoneNumber1' => '97125629934',
            'PhoneNumber1Ext' => '',
            'PhoneNumber2' => '971549989798',
            'PhoneNumber2Ext' => '',
            'FaxNumber' => null,
            'CellPhone' => '97125629934',
            'EmailAddress' => 'info@sqrneo.com',
            'Type' => ''
        ];
    }

    private function getShipperPartyAddressData(): array
    {
        return [
            'Line1' => '46CP+94 - Al Quoz - Al Quoz Industrial Area 4 - Dubai',
            'Line2' => '',
            'Line3' => "",
            'City' => 'Dubai',
            'StateOrProvinceCode' => '',
            'PostCode' => '',
            'CountryCode' => 'AE',
            'Longitude' => 0,
            'Latitude' => 0,
            'BuildingNumber' => null,
            'BuildingName' => null,
            'Floor' => null,
            'Apartment' => null,
            'POBox' => null,
            'Description' => null
        ];
    }

    private function getClientInfoData(): array
    {
        return [
            'UserName' => $this->config['UserName'],
            'Password' => $this->config['Password'],
            'Version' => $this->config['Version'],
            'AccountNumber' => $this->config['AccountNumber'],
            'AccountPin' => $this->config['AccountPin'],
            'AccountEntity' => $this->config['AccountEntity'],
            'AccountCountryCode' => $this->config['AccountCountryCode'],
            'Source' => 0,
            'PreferredLanguageCode' => null,
        ];
    }

    public function getTransactionData()
    {
        return null;
    }

    private function getConfig(): array
    {
        return config('services.aramex.' . $this->getEnvironment());
    }

    private function getEnvironment(): string
    {
        return config('services.aramex.env') == 'prod' ? 'prod' : 'test';
    }

    private function getNumberOfPieces(): int
    {
        return intval($this->task->total_cards);
    }

    private function getShipperDetailsData(): array
    {
        return [
            'Dimensions' => [
                'Length' => 0,
                'Width' => 0,
                'Height' => 0,
                'Unit' => 'CM'
            ],
            'ActualWeight' => [
                'Unit' => 'KG',
                'Value' => 0.5
            ],
            'ChargeableWeight' => [
                'Unit' => 'KG',
                'Value' => 0
            ],
            'DescriptionOfGoods' => "Business Cards",
            'GoodsOriginCountry' => "AE",
            'NumberOfPieces' => $this->getNumberOfPieces(),
            'ProductGroup' => "DOM",
            'ProductType' => "ONP",
            'PaymentType' => "P",
            'PaymentOptions' => "ACCT",
            'CustomsValueAmount' => [
                'CurrencyCode' => 'AED',
                'Value' => 10
            ],
            'CashOnDeliveryAmount' => [
                'CurrencyCode' => 'AED',
                'Value' => 0
            ],
            'InsuranceAmount' => [
                'CurrencyCode' => 'AED',
                'Value' => 0
            ],
            'CashAdditionalAmount' => [
                'CurrencyCode' => 'AED',
                'Value' => 0
            ],
            'CashAdditionalAmountDescription' => null,
            'CollectAmount' => [
                'CurrencyCode' => 'AED',
                'Value' => 0
            ],
            'Services' => '',
            'Items' => [
                [
                    'PackageType' => 'Business Card',
                    'Quantity' => $this->getNumberOfPieces(),
                    'Weight' => [
                        'Unit' => 'CM',
                        'Value' => 0,
                    ],
                    'Comments' => 'no description',
                    'Reference' => 'no barcode',
                    'PiecesDimensions' => null,
                    'CommodityCode' => null,
                    'GoodsDescription' => null,
                    'CountryOfOrigin' => null,
                    'CustomsValue' => null,
                    'ContainerNumber' => null
                ]
            ],
            'DeliveryInstructions' => null,
            'AdditionalProperties' => null,
            'ContainsDangerousGoods' => false
        ];
    }


}
