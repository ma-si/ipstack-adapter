<?php

/**
 * Geolocation Ipstack (http://mateuszsitek.com/projects/geolocation-ipstack)
 *
 * @copyright Copyright (c) 2017-2018 DIGITAL WOLVES LTD (http://digitalwolves.ltd) All rights reserved.
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */

namespace Aist\Ipstack\Client;

use Aist\Ipstack\Exceptions\InvalidParameterException;

class ParameterBag
{
    const PROTOCOL_HTTP = 'http';
    const PROTOCOL_HTTPS = 'https';

    const FORMAT_JSON = 'json';
    const FORMAT_XML = 'xml';

    const FIELDS = [
        "main",
        "ip",
        "hostname",
        "type",
        "continent_code",
        "continent_name",
        "country_code",
        "country_name",
        "region_code",
        "region_name",
        "city",
        "zip",
        "latitude",
        "longitude",
        "location",
        "location.geoname_id",
        "location.capital",
        "location.languages",
        "location.languages.code",
        "location.languages.name",
        "native.location.languages",
        "country_flag",
        "country_flag_emoji",
        "country_flag_emoji_unicode",
        "calling_code",
        "is_eu"
    ];

    const LANGUAGES = [
        'en',
        'de',
        'es',
        'fr',
        'ja',
        'pt-br',
        'ru',
        'zh'
    ];

    private static $formats = [
        self::FORMAT_JSON,
        self::FORMAT_XML
    ];

    private static $protocols = [self::PROTOCOL_HTTP, self::PROTOCOL_HTTPS];

    /**
     * @var string
     */
    protected $key;

    /**
     * @var string
     */
    protected $protocol;

    /**
     * @var array
     */
    protected $fields;

    /**
     * @var string
     */
    protected $language;

    /**
     * @var string
     */
    protected $format;

    /**
     * @param string|null $key
     */
    public function __construct($key = null)
    {
        $this->key = $key;
        $this->protocol = self::PROTOCOL_HTTP;
        $this->fields = [];
        $this->language = 'en';
        $this->format = self::FORMAT_JSON;
    }

    /**
     * @return string|null
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getProtocol()
    {
        return $this->protocol;
    }

    /**
     * @param string $protocol
     * @return ParameterBag
     * @throws InvalidParameterException
     */
    public function setProtocol($protocol)
    {
        if (! in_array($protocol, self::$protocols)) {
            throw new InvalidParameterException(
                sprintf(
                    "Invalid protocol '%s'. Please, use one of existing protocols [%s]",
                    $protocol,
                    implode(',', self::$protocols)
                )
            );
        }

        $this->protocol = $protocol;

        return $this;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string $language
     * @return ParameterBag
     * @throws InvalidParameterException
     */
    public function setLanguage($language)
    {
        if (! in_array($language, self::LANGUAGES)) {
            throw new InvalidParameterException(
                sprintf(
                    "Invalid language '%s'. Please, use one of existing languages [%s]",
                    $language,
                    implode(',', self::$languages)
                )
            );
        }

        $this->language = $language;

        return $this;
    }

    /**
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @param string $format
     * @return ParameterBag
     * @throws InvalidParameterException
     */
    public function setFormat($format)
    {
        if (! in_array($format, self::$formats)) {
            throw new InvalidParameterException(
                sprintf(
                    "Invalid output format '%s'. Please, use one of existing formats [%s]",
                    $format,
                    implode(',', self::$formats)
                )
            );
        }

        $this->format = $format;

        return $this;
    }

    /**
     * @param string $field
     * @return ParameterBag
     * @throws InvalidParameterException
     */
    public function addField($field)
    {
        if (! in_array($field, self::FIELDS)) {
            throw new InvalidParameterException(
                sprintf(
                    "Invalid field '%s'. Please, use one of existing fields [%s]",
                    $field,
                    implode(',', self::FIELDS)
                )
            );
        }

        if (! in_array($field, $this->fields)) {
            $this->fields[] = $field;
        }

        return $this;
    }

    /**
     * @param string $field
     * @return ParameterBag
     */
    public function removeField($field)
    {
        if (($key = array_search($field, $this->fields)) !== false) {
            unset($this->fields[$key]);
        }

        return $this;
    }

    /**
     * @param array $fields
     * @return ParameterBag
     * @throws InvalidParameterException
     */
    public function setFields($fields)
    {
        foreach ($fields as $field) {
            $this->addField($field);
        }

        return $this;
    }

    /**
     * @return ParameterBag
     */
    public function clearFields()
    {
        $this->fields = [];

        return $this;
    }

    /**
     * @return array
     */
    public function getFields()
    {
        return $this->fields;
    }
}
