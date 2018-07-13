<?php

/**
 * Geolocation Ipstack (http://mateuszsitek.com/projects/geolocation-ipstack)
 *
 * @copyright Copyright (c) 2017-2018 DIGITAL WOLVES LTD (http://digitalwolves.ltd) All rights reserved.
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */

namespace Aist\Ipstack\Client;

use Aist\Geolocation\Entity\Location;
use Aist\Ipstack\Client\ParameterBag;
use Aist\Ipstack\Exceptions\InvalidApiException;

class Client
{
    const URL = 'api.ipstack.com';

    /**
     * @var ParameterBag
     */
    private $params;

    /**
     * @param string $key <p>API Access Key</p>
     *
     * @throws InvalidApiException
     */
    public function __construct($key = null)
    {
        if ($key === null) {
            throw new InvalidApiException('You have not API Access Key');
        }

        $this->params = new ParameterBag($key);
    }

    /**
     * Get data by ip from api ipstack
     *
     * @param string $ip
     * @param bool $isArray
     *
     * @return mixed
     * @throws InvalidApiException
     */
    public function get($ip, $isArray = false)
    {
        $result = $this->request($this->getUrl($ip));

        if (isset($result['error'])) {
            throw new InvalidApiException(
                "[{$result['error']['code']}][{$result['error']['type']}}] {$result['error']['info']}}"
            );
        }

        return $isArray ? $result : $this->createLocation($result);
    }

    /**
     * Get data by array ip's from api ipstack
     *
     * @param array $ips
     * @param bool $isArray
     *
     * @return mixed
     * @throws InvalidApiException
     */
    public function getBulk(array $ips, $isArray = false)
    {
        $result = $this->request($this->getUrl(implode(',', $ips)));

        if ($result['error']) {
            throw new InvalidApiException(
                "[{$result['error']['code']}][{$result['error']['type']}}] {$result['error']['info']}}"
            );
        }

        if (! $isArray) {
            foreach ($result as $key => $locationData) {
                $result[$key] = $this->createLocation($locationData);
            }
        }

        return $result;
    }

    /**
     * @param string $url
     *
     * @return array
     */
    private function request($url)
    {
        $c = curl_init($url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($c);
        curl_close($c);

        if ($this->params->getFormat() === ParameterBag::FORMAT_XML) {
            $xml = simplexml_load_string($response);
            $response = json_encode($xml);
        }

        return json_decode($response, true);
    }

    /**
     * Generate url with api key
     *
     * @param string $ip
     * @return string
     */
    public function getUrl($ip)
    {
        return sprintf(
            '%s://%s/%s?access_key=%s&fields=%s&language=%s&output=%s',
            $this->params->getProtocol(),
            self::URL,
            $ip,
            $this->params->getKey(),
            implode(',', $this->params->getFields()),
            $this->params->getLanguage(),
            $this->params->getFormat()
        );
    }

    /**
     * @param array $data
     *
     * @return Location
     */
    private function createLocation($data)
    {
        $location = new Location();

        $location->setCity(isset($data['city']) ? $data['city'] : null)
            ->setContinentCode(isset($data['continent_code']) ? $data['continent_code'] : null)
            ->setContinentName(isset($data['continent_name']) ? $data['continent_name'] : null)
            ->setCountryCode(isset($data['country_code']) ? $data['country_code'] : null)
            ->setCountryName(isset($data['country_name']) ? $data['country_name'] : null)
            ->setCountryFlag(
                isset($data['location'])
                &&
                isset($data['location']['country_flag'])
                    ?
                    $data['location']['country_flag']
                    :
                    null
            )
            ->setLatitude(isset($data['latitude']) ? $data['latitude'] : null)
            ->setLongitude(isset($data['longitude']) ? $data['longitude'] : null)
            ->setRegionCode(isset($data['region_code']) ? $data['region_code'] : null)
            ->setRegionName(isset($data['region_name']) ? $data['region_name'] : null)
            ->setZip(isset($data['zip']) ? $data['zip'] : null)
            ->setIpAddress(isset($data['ip']) ? $data['ip'] : null)
            ->setValid((isset($data['type']) && $data['type'] !== null))
        ;

        return $location;
    }

    /**
     * @return ParameterBag
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param ParameterBag
     * @return void
     */
    public function setParams($params)
    {
        $this->params = $params;
    }
}
