<?php

namespace Doar;

use Doar\Services\DoarService;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;

/**
 * Postage calculator for Israel Postal Company.
 */
class DoarCalculator
{
    const API_URL = 'https://www.israelpost.co.il/npostcalc.nsf/CalcPrice';
    const MENU_CHOSEN = 'משלוח דואר בארץ~מכתב';

    /**
     * Postal-service codes.
     */
    const PRIORITY_POST24 = 'דואר 24';
    const REGISTERED_RAPID = 'רשום מהיר';
    const STANDARD_DELIVERY = 'משלוח רגיל';
    const REGISTERED_WITH_CONFIRMATION = 'רשום~עם אישור מסירה';
    const REGISTERED_WITHOUT_CONFIRMATION = 'רשום~ללא אישור מסירה';
    const REGISTERED_CONFIRMATION_AND_SCAN = 'רשום~עם אישור מסירה וסריקה';

    protected $serviceOptions = [
        1 => self::PRIORITY_POST24,
        2 => self::REGISTERED_RAPID,
        3 => self::STANDARD_DELIVERY,
        4 => self::REGISTERED_WITH_CONFIRMATION,
        5 => self::REGISTERED_WITHOUT_CONFIRMATION,
        6 => self::REGISTERED_CONFIRMATION_AND_SCAN,
    ];

    /**
     * @var ClientInterface
     */
    protected $httpClient;

    /**
     * GET parameters.
     */
    protected $params = [
        'qty'           => 0,
        'weight'        => 0,
        'lang'          => 'HE',
        'openagent'	    => '',
        'menuChosen'    => self::MENU_CHOSEN,
        'serviceoption' => '',
    ];

    /**
     * @param array           $options
     * @param ClientInterface $client
     *
     * @return void
     */
    public function __construct(array $options = [], ClientInterface $client = null)
    {
        $this->httpClient = (null !== $client) ? $client : new Client($options, $client);
    }

    /**
     * @return array
     */
    public function getServiceOptions()
    {
        return $this->serviceOptions;
    }

    /**
     * @return ClientInterface
     */
    public function getClient()
    {
        return $this->httpClient;
    }

    /**
     * @param ClientInterface $client
     *
     * @return $this
     */
    public function setClient(ClientInterface $client)
    {
        $this->httpClient = $client;

        return $this;
    }

    /**
     * @param int $weight
     *
     * @return $this
     */
    public function setWeight($weight)
    {
        $this->params['weight'] = $weight;

        return $this;
    }

    /**
     * @param int $quantity
     *
     * @return $this
     */
    public function setQuantity($quantity)
    {
        $this->params['qty'] = $quantity;

        return $this;
    }

    /**
     * @param string $language
     *
     * @return $this
     */
    public function setLanguage($language)
    {
        $this->params['lang'] = $language;

        return $this;
    }

    /**
     * @param string|int $option
     *
     * @throws \DoarException
     *
     * @return $this
     */
    public function setServiceOption($option)
    {
        if (isset($this->serviceOptions[$option])) {
            $this->params['serviceoption'] = $this->serviceOptions[$option];
        } elseif (in_array($option, $this->serviceOptions)) {
            $this->params['serviceoption'] = $option;
        } else {
            throw new \DoarException('Invalid service option.');
        }

        return $this;
    }

    /**
     * Make an HTTP GET request to API.
     *
     * @throws \RequestException
     *
     * @return Services\DoarService
     */
    public function Calculate()
    {
        try {
            $response = $this->getClient()->request('GET', self::API_URL, ['query' => $this->params]);
            $std = json_decode($response->getBody()->getContents());
            $service = new DoarService();

            return $service->newFromStd($std);
        } catch (RequestException $e) {
            return $e;
        }
    }
}
