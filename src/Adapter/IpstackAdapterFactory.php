<?php

/**
 * Geolocation Ipstack (http://mateuszsitek.com/projects/geolocation-ipstack)
 *
 * @copyright Copyright (c) 2017-2018 DIGITAL WOLVES LTD (http://digitalwolves.ltd) All rights reserved.
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */

namespace Aist\Ipstack\Adapter;

use Aist\Ipstack\Adapter\IpstackAdapter;
use Aist\Ipstack\Client\Client;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class IpstackAdapterFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $client = $container->get(Client::class);
        $adapter = new IpstackAdapter($client);

        return $adapter;
    }

    /**
     * Backwards-compatibility
     *
     * @param ServiceLocatorInterface $container
     * @return Client|object
     * @throws \Interop\Container\Exception\ContainerException
     */
    public function createService(ServiceLocatorInterface $container)
    {
        return $this($container, IpstackAdapter::class);
    }
}
