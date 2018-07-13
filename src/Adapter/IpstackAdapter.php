<?php

/**
 * Geolocation Ipstack (http://mateuszsitek.com/projects/geolocation-ipstack)
 *
 * @copyright Copyright (c) 2017-2018 DIGITAL WOLVES LTD (http://digitalwolves.ltd) All rights reserved.
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */

namespace Aist\Ipstack\Adapter;

class IpstackAdapter implements \Aist\Geolocation\Adapter\AdapterInterface
{
    private $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function get($ip)
    {
        return $this->client->get($ip);
    }
}
