<?php

/**
 * @package    contao-backend-theme
 * @author     heart-bits <hi@heart-bits.com>
 * @copyright  2017 heart-bits Sascha Wustmann. All rights reserved.
 * @filesource
 *
 */

namespace Heartbits\ContaoBackendTheme\ContaoManager;

use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Heartbits\ContaoBackendTheme\HeartbitsContaoBackendThemeBundle;
use Contao\CoreBundle\ContaoCoreBundle;

/**
 * Class Plugin.
 *
 * @package ContaoManager
 */
class ContaoManagerPlugin implements BundlePluginInterface
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
}
