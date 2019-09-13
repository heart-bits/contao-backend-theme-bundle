<?php

/**
 * @package    contao-backend-theme
 * @author     heart-bits <hi@heart-bits.com>
 * @copyright  2019 heart-bits Sascha Wustmann. All rights reserved.
 * @filesource
 *
 */

namespace Heartbits\ContaoBackendTheme\ContaoManager;

use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Contao\ManagerPlugin\Routing\RoutingPluginInterface;
use Symfony\Component\Config\Loader\LoaderResolverInterface;
use Symfony\Component\HttpKernel\KernelInterface;
use Heartbits\ContaoBackendTheme\HeartbitsContaoBackendThemeBundle;
use Contao\CoreBundle\ContaoCoreBundle;

/**
 * Class Plugin.
 *
 * @package ContaoManager
 */
class Plugin implements BundlePluginInterface, RoutingPluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(HeartbitsContaoBackendThemeBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class])
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getRouteCollection(LoaderResolverInterface $resolver, KernelInterface $kernel)
    {
        return $resolver
            ->resolve(__DIR__.'/../Resources/config/routing.yml')
            ->load(__DIR__.'/../Resources/config/routing.yml')
            ;
    }
}
