<?php
namespace Doar;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;

class DoarCalculator
{
	const API_URL = 'https://www.israelpost.co.il/npostcalc.nsf/CalcPrice';

	const MENU_CHOSEN = 'משלוח דואר בארץ~מכתב';

	protected $httpClient;

	protected $config = [
		'qty' => 0,
		'weight' => 0,
		'lang' => 'HE',
		'openagent'	=> '',
		'menuChosen' => self::MENU_CHOSEN,
		'serviceoption' => ''
	];

	public $serviceOptions = [
		'regular'		=> 'משלוח רגיל',
		'confirmation'	=> 'רשום~עם אישור מסירה',
		'registered'	=> 'רשום~ללא אישור מסירה',
		'scanned'		=> 'רשום~עם אישור מסירה וסריקה',
		'twentyfour'	=> 'דואר 24',
		'express'		=> 'רשום מהיר'
	];

	public function __construct(array $options = array(), ClientInterface $client = null)
	{
		$this->httpClient = (null !== $client) ? $client : new Client($options, $client);
	}

	public function getClient()
	{
		return $this->httpClient;
	}

	public function setClient(ClientInterface $client)
	{
		$this->httpClient = $client;
		return $this;
	}

	public function setWeight($weight)
	{
		$this->config['weight'] = $weight;
		return $this;
	}

	public function setQuantity($quantity)
	{
		$this->config['qty'] = $quantity;
		return $this;
	}

	public function setLanguage($language)
	{
		$this->config['lang'] = $language;
		return $this;
	}

	public function setServiceOption($option)
	{
		$this->config['serviceoption'] = $option;
		return $this;
	}

	public function Calculate()
	{
		try {
			$response = $this->getClient()->request('GET', self::API_URL, [ 'query' => $this->config ]);
			return json_decode($response->getBody()->getContents());
		} catch (RequestException $e) {
			return $e;
		}
	}
}
