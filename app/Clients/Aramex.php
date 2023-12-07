<?php
declare(strict_types=1);


namespace App\Clients;

use App\Models\Task;
use Illuminate\Support\Facades\Http;

class Aramex
{

    private array $config;
    private Task $task;
//    private string $url = 'https://ws.sbx.aramex.net/shippingapi.v2/shipping/service_1_0.svc/json/CreateShipments'; // TOOD: make function
    private string $url = 'https://ws.aramex.net/shippingapi.v2/shipping/service_1_0.svc/json/CreateShipments'; // TOOD: make function
    private $countries = [
        'AF' => 'Afghanistan',
        'AX' => 'Aland Islands',
        'AL' => 'Albania',
        'DZ' => 'Algeria',
        'AS' => 'American Samoa',
        'AD' => 'Andorra',
        'AO' => 'Angola',
        'AI' => 'Anguilla',
        'AQ' => 'Antarctica',
        'AG' => 'Antigua And Barbuda',
        'AR' => 'Argentina',
        'AM' => 'Armenia',
        'AW' => 'Aruba',
        'AU' => 'Australia',
        'AT' => 'Austria',
        'AZ' => 'Azerbaijan',
        'BS' => 'Bahamas',
        'BH' => 'Bahrain',
        'BD' => 'Bangladesh',
        'BB' => 'Barbados',
        'BY' => 'Belarus',
        'BE' => 'Belgium',
        'BZ' => 'Belize',
        'BJ' => 'Benin',
        'BM' => 'Bermuda',
        'BT' => 'Bhutan',
        'BO' => 'Bolivia',
        'BA' => 'Bosnia And Herzegovina',
        'BW' => 'Botswana',
        'BV' => 'Bouvet Island',
        'BR' => 'Brazil',
        'IO' => 'British Indian Ocean Territory',
        'BN' => 'Brunei Darussalam',
        'BG' => 'Bulgaria',
        'BF' => 'Burkina Faso',
        'BI' => 'Burundi',
        'KH' => 'Cambodia',
        'CM' => 'Cameroon',
        'CA' => 'Canada',
        'CV' => 'Cape Verde',
        'KY' => 'Cayman Islands',
        'CF' => 'Central African Republic',
        'TD' => 'Chad',
        'CL' => 'Chile',
        'CN' => 'China',
        'CX' => 'Christmas Island',
        'CC' => 'Cocos (Keeling) Islands',
        'CO' => 'Colombia',
        'KM' => 'Comoros',
        'CG' => 'Congo',
        'CD' => 'Congo, Democratic Republic',
        'CK' => 'Cook Islands',
        'CR' => 'Costa Rica',
        'CI' => 'Cote D\'Ivoire',
        'HR' => 'Croatia',
        'CU' => 'Cuba',
        'CY' => 'Cyprus',
        'CZ' => 'Czech Republic',
        'DK' => 'Denmark',
        'DJ' => 'Djibouti',
        'DM' => 'Dominica',
        'DO' => 'Dominican Republic',
        'EC' => 'Ecuador',
        'EG' => 'Egypt',
        'SV' => 'El Salvador',
        'GQ' => 'Equatorial Guinea',
        'ER' => 'Eritrea',
        'EE' => 'Estonia',
        'ET' => 'Ethiopia',
        'FK' => 'Falkland Islands (Malvinas)',
        'FO' => 'Faroe Islands',
        'FJ' => 'Fiji',
        'FI' => 'Finland',
        'FR' => 'France',
        'GF' => 'French Guiana',
        'PF' => 'French Polynesia',
        'TF' => 'French Southern Territories',
        'GA' => 'Gabon',
        'GM' => 'Gambia',
        'GE' => 'Georgia',
        'DE' => 'Germany',
        'GH' => 'Ghana',
        'GI' => 'Gibraltar',
        'GR' => 'Greece',
        'GL' => 'Greenland',
        'GD' => 'Grenada',
        'GP' => 'Guadeloupe',
        'GU' => 'Guam',
        'GT' => 'Guatemala',
        'GG' => 'Guernsey',
        'GN' => 'Guinea',
        'GW' => 'Guinea-Bissau',
        'GY' => 'Guyana',
        'HT' => 'Haiti',
        'HM' => 'Heard Island & Mcdonald Islands',
        'VA' => 'Holy See (Vatican City State)',
        'HN' => 'Honduras',
        'HK' => 'Hong Kong',
        'HU' => 'Hungary',
        'IS' => 'Iceland',
        'IN' => 'India',
        'ID' => 'Indonesia',
        'IR' => 'Iran, Islamic Republic Of',
        'IQ' => 'Iraq',
        'IE' => 'Ireland',
        'IM' => 'Isle Of Man',
        'IL' => 'Israel',
        'IT' => 'Italy',
        'JM' => 'Jamaica',
        'JP' => 'Japan',
        'JE' => 'Jersey',
        'JO' => 'Jordan',
        'KZ' => 'Kazakhstan',
        'KE' => 'Kenya',
        'KI' => 'Kiribati',
        'KR' => 'Korea',
        'KW' => 'Kuwait',
        'KG' => 'Kyrgyzstan',
        'LA' => 'Lao People\'s Democratic Republic',
        'LV' => 'Latvia',
        'LB' => 'Lebanon',
        'LS' => 'Lesotho',
        'LR' => 'Liberia',
        'LY' => 'Libyan Arab Jamahiriya',
        'LI' => 'Liechtenstein',
        'LT' => 'Lithuania',
        'LU' => 'Luxembourg',
        'MO' => 'Macao',
        'MK' => 'Macedonia',
        'MG' => 'Madagascar',
        'MW' => 'Malawi',
        'MY' => 'Malaysia',
        'MV' => 'Maldives',
        'ML' => 'Mali',
        'MT' => 'Malta',
        'MH' => 'Marshall Islands',
        'MQ' => 'Martinique',
        'MR' => 'Mauritania',
        'MU' => 'Mauritius',
        'YT' => 'Mayotte',
        'MX' => 'Mexico',
        'FM' => 'Micronesia, Federated States Of',
        'MD' => 'Moldova',
        'MC' => 'Monaco',
        'MN' => 'Mongolia',
        'ME' => 'Montenegro',
        'MS' => 'Montserrat',
        'MA' => 'Morocco',
        'MZ' => 'Mozambique',
        'MM' => 'Myanmar',
        'NA' => 'Namibia',
        'NR' => 'Nauru',
        'NP' => 'Nepal',
        'NL' => 'Netherlands',
        'AN' => 'Netherlands Antilles',
        'NC' => 'New Caledonia',
        'NZ' => 'New Zealand',
        'NI' => 'Nicaragua',
        'NE' => 'Niger',
        'NG' => 'Nigeria',
        'NU' => 'Niue',
        'NF' => 'Norfolk Island',
        'MP' => 'Northern Mariana Islands',
        'NO' => 'Norway',
        'OM' => 'Oman',
        'PK' => 'Pakistan',
        'PW' => 'Palau',
        'PS' => 'Palestinian Territory, Occupied',
        'PA' => 'Panama',
        'PG' => 'Papua New Guinea',
        'PY' => 'Paraguay',
        'PE' => 'Peru',
        'PH' => 'Philippines',
        'PN' => 'Pitcairn',
        'PL' => 'Poland',
        'PT' => 'Portugal',
        'PR' => 'Puerto Rico',
        'QA' => 'Qatar',
        'RE' => 'Reunion',
        'RO' => 'Romania',
        'RU' => 'Russian Federation',
        'RW' => 'Rwanda',
        'BL' => 'Saint Barthelemy',
        'SH' => 'Saint Helena',
        'KN' => 'Saint Kitts And Nevis',
        'LC' => 'Saint Lucia',
        'MF' => 'Saint Martin',
        'PM' => 'Saint Pierre And Miquelon',
        'VC' => 'Saint Vincent And Grenadines',
        'WS' => 'Samoa',
        'SM' => 'San Marino',
        'ST' => 'Sao Tome And Principe',
        'SA' => 'Saudi Arabia',
        'SN' => 'Senegal',
        'RS' => 'Serbia',
        'SC' => 'Seychelles',
        'SL' => 'Sierra Leone',
        'SG' => 'Singapore',
        'SK' => 'Slovakia',
        'SI' => 'Slovenia',
        'SB' => 'Solomon Islands',
        'SO' => 'Somalia',
        'ZA' => 'South Africa',
        'GS' => 'South Georgia And Sandwich Isl.',
        'ES' => 'Spain',
        'LK' => 'Sri Lanka',
        'SD' => 'Sudan',
        'SR' => 'Suriname',
        'SJ' => 'Svalbard And Jan Mayen',
        'SZ' => 'Swaziland',
        'SE' => 'Sweden',
        'CH' => 'Switzerland',
        'SY' => 'Syrian Arab Republic',
        'TW' => 'Taiwan',
        'TJ' => 'Tajikistan',
        'TZ' => 'Tanzania',
        'TH' => 'Thailand',
        'TL' => 'Timor-Leste',
        'TG' => 'Togo',
        'TK' => 'Tokelau',
        'TO' => 'Tonga',
        'TT' => 'Trinidad And Tobago',
        'TN' => 'Tunisia',
        'TR' => 'Turkey',
        'TM' => 'Turkmenistan',
        'TC' => 'Turks And Caicos Islands',
        'TV' => 'Tuvalu',
        'UG' => 'Uganda',
        'UA' => 'Ukraine',
        'AE' => 'United Arab Emirates',
        'GB' => 'United Kingdom',
        'US' => 'United States',
        'UM' => 'United States Outlying Islands',
        'UY' => 'Uruguay',
        'UZ' => 'Uzbekistan',
        'VU' => 'Vanuatu',
        'VE' => 'Venezuela',
        'VN' => 'Viet Nam',
        'VG' => 'Virgin Islands, British',
        'VI' => 'Virgin Islands, U.S.',
        'WF' => 'Wallis And Futuna',
        'EH' => 'Western Sahara',
        'YE' => 'Yemen',
        'ZM' => 'Zambia',
        'ZW' => 'Zimbabwe',
    ];

    private $jayParsedAry = [
        "Shipments" => [
            [
                "Reference1" => "Shipment Reference",
                "Reference2" => null,
                "Reference3" => null,
                "Shipper" => [
                    "Reference1" => "Shipper Reference -{{testname}}",
                    "Reference2" => null,
                    "AccountNumber" => "45796",
                    "PartyAddress" => [
                        "Line1" => "Test Shipper Address Line1{{testname}}",
                        "Line2" => "Test Shipper Address Line2{{testname}}",
                        "Line3" => "",
                        "City" => "Dubai",
                        "StateOrProvinceCode" => "",
                        "PostCode" => "000000",
                        "CountryCode" => "AE",
                        "Longitude" => 0,
                        "Latitude" => 0,
                        "BuildingNumber" => null,
                        "BuildingName" => null,
                        "Floor" => null,
                        "Apartment" => null,
                        "POBox" => null,
                        "Description" => null
                    ],
                    "Contact" => [
                        "Department" => null,
                        "PersonName" => "Test Shipper Name",
                        "Title" => null,
                        "CompanyName" => "Test Shipper Name/Test Shipper Company Name",
                        "PhoneNumber1" => "048707766",
                        "PhoneNumber1Ext" => "",
                        "PhoneNumber2" => "",
                        "PhoneNumber2Ext" => "",
                        "FaxNumber" => null,
                        "CellPhone" => "971556893100",
                        "EmailAddress" => "test@aramex.com",
                        "Type" => ""
                    ]
                ],
                "Consignee" => [
                    "Reference1" => null,
                    "Reference2" => null,
                    "AccountNumber" => null,
                    "PartyAddress" => [
                        "Line1" => "Test Consignee Address Line1",
                        "Line2" => "Test Consignee Address Line2",
                        "Line3" => "Test Consignee Address Line3",
                        "City" => "Dubai",
                        "StateOrProvinceCode" => "FU",
                        "PostCode" => "",
                        "CountryCode" => "AE",
                        "Longitude" => 0,
                        "Latitude" => 0,
                        "BuildingNumber" => null,
                        "BuildingName" => null,
                        "Floor" => null,
                        "Apartment" => null,
                        "POBox" => null,
                        "Description" => null
                    ],
                    "Contact" => [
                        "Department" => null,
                        "PersonName" => "Test Consignee Name",
                        "Title" => null,
                        "CompanyName" => "Test Consignee/Company Name",
                        "PhoneNumber1" => "048707766",
                        "PhoneNumber1Ext" => "",
                        "PhoneNumber2" => "",
                        "PhoneNumber2Ext" => "",
                        "FaxNumber" => null,
                        "CellPhone" => "971556893100",
                        "EmailAddress" => "tets@hotmail.com",
                        "Type" => ""
                    ]
                ],
                "ThirdParty" => null,
                "ShippingDateTime" => "/Date(1701937486195)/",
                "DueDate" => "/Date(1701937486195)/",
                "Comments" => null,
                "PickupLocation" => null,
                "OperationsInstructions" => null,
                "AccountingInstrcutions" => null,
                "Details" => [
                    "Dimensions" => [
                        "Length" => 0,
                        "Width" => 0,
                        "Height" => 0,
                        "Unit" => "CM"
                    ],
                    "ActualWeight" => [
                        "Unit" => "KG",
                        "Value" => 0.1
                    ],
                    "ChargeableWeight" => [
                        "Unit" => "KG",
                        "Value" => 0
                    ],
                    "DescriptionOfGoods" => "Items",
                    "GoodsOriginCountry" => "AE",
                    "NumberOfPieces" => 1,
                    "ProductGroup" => "DOM",
                    "ProductType" => "ONP",
                    "PaymentType" => "P",
                    "PaymentOptions" => "ACCT",
                    "CustomsValueAmount" => [
                        "CurrencyCode" => "AED",
                        "Value" => 10
                    ],
                    "CashOnDeliveryAmount" => [
                        "CurrencyCode" => "AED",
                        "Value" => 0
                    ],
                    "InsuranceAmount" => [
                        "CurrencyCode" => "AED",
                        "Value" => 0
                    ],
                    "CashAdditionalAmount" => [
                        "CurrencyCode" => "AED",
                        "Value" => 0
                    ],
                    "CashAdditionalAmountDescription" => null,
                    "CollectAmount" => [
                        "CurrencyCode" => "AED",
                        "Value" => 0
                    ],
                    "Services" => "",
                    "Items" => [
                        [
                            "PackageType" => "item",
                            "Quantity" => 1,
                            "Weight" => [
                                "Unit" => "CM",
                                "Value" => 0
                            ],
                            "Comments" => "no description",
                            "Reference" => "no barcode",
                            "PiecesDimensions" => null,
                            "CommodityCode" => null,
                            "GoodsDescription" => null,
                            "CountryOfOrigin" => null,
                            "CustomsValue" => null,
                            "ContainerNumber" => null
                        ]
                    ],
                    "DeliveryInstructions" => null,
                    "AdditionalProperties" => null,
                    "ContainsDangerousGoods" => false
                ],
                "Attachments" => null,
                "ForeignHAWB" => null,
                "TransportType " => 0,
                "PickupGUID" => null,
                "Number" => null,
                "ScheduledDelivery" => null
            ]
        ],
        "LabelInfo" => [
            "ReportID" => 9729,
            "ReportType" => "URL"
        ],
        "ClientInfo" => [
            "UserName" => "dxbit@aramex.com",
            "Password" => 'Ar@m3x$h1pp1ng',
            "Version" => "v1",
            "AccountNumber" => "45796",
            "AccountPin" => "116216",
            "AccountEntity" => "DXB",
            "AccountCountryCode" => "AE",
            "Source" => 24,
            "PreferredLanguageCode" => null
        ],
        "Transaction" => null
    ];
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


    public function sendCreateShipmentsRequest(): \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
    {

        return Http::withHeaders($this->getHeaders())
            ->post($this->url, $this->getCreateShipmentsData());
    }
    public function sendTestCreateShipmentsRequest(): \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
    {

        var_dump($this->getTestCreateShipmentsData());
        return Http::withHeaders($this->getHeaders())
            ->post($this->url, $this->getTestCreateShipmentsData());
    }

    private function getCreateShipmentsData(): array
    {
        return [
            'Shipments' => [$this->getShipmentsData()],
            'LabelInfo' => [
                'ReportID' => 9729,
                'ReportType' => "URL"
            ],
            'ClientInfo' => $this->getClientInfoData(),
            'Transaction' => $this->getTransactionData(),
        ];
    }
    private function getTestCreateShipmentsData(): array
    {
        return [
            'ClientInfo' => $this->getClientInfoData(),
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
            'ShippingDateTime' => "/Date(" . now()->getTimestampMs() . ")/",
            'DueDate' => "/Date(" . now()->getTimestampMs() . ")/",
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
            'ScheduledDelivery' => null,
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
            'Reference1' => $this->task->company_name,
            'Reference2' => null,
            'AccountNumber' => null,
            'PartyAddress' => $this->getConsigneePartyAddressData(),
            'Contact' => $this->getConsigneeContactData(),
        ];
    }

    private function getConsigneePartyAddressData(): array
    {
        return [
            'Line1' => $this->task->address,
            'Line2' => "",
            'Line3' => "",
            'City' => $this->task->emirate,
            'StateOrProvinceCode' => null,
            'PostCode' => "",
            'CountryCode' => $this->getCountryCode(),
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
            'PersonName' => $this->task->contact_name,
            'Title' => null,
            'CompanyName' => $this->task->contact_name,
            'PhoneNumber1' => str_replace('+', '', $this->task->contact_number),
            'PhoneNumber1Ext' => "",
            'PhoneNumber2' => "",
            'PhoneNumber2Ext' => "",
            'FaxNumber' => null,
            'CellPhone' => str_replace('+', '', $this->task->contact_number),
            'EmailAddress' => $this->task->contact_email,
            'Type' => ""
        ];
    }

    private function getShipperContactData(): array
    {
        return [
            'Department' => null,
            'PersonName' => 'SQR Card',
            'Title' => 'SQR Card',
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
            'Line1' => '46CP+94',
            'Line2' => 'Al Quoz',
            'Line3' => 'Al Quoz Industrial Area 4',
            'City' => 'Dubai',
            'StateOrProvinceCode' => '',
            'PostCode' => '',
            'CountryCode' => 'AE',
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
            'Source' => 24,
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

    private function getCountryCode()
    {
        if ($this->task->country) {
            foreach ($this->countries as $code => $country) {
                if (strtolower($country) == trim(strtolower($this->task->country))) {
                    return $code;
                }
            }
        }

        return 'AE';
    }


}
