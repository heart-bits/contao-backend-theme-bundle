<?php

/**
 * @package    contao-backend-theme
 * @author     heart-bits <hi@heart-bits.com>
 * @copyright  2017 heart-bits Sascha Wustmann. All rights reserved.
 * @filesource
 *
 */

namespace Heartbits\Contao\BackendTheme\Listener;

use Contao\Config;
use Contao\CoreBundle\Framework\ContaoFrameworkInterface as ContaoFramework;

/**
 * Hook listener.
 *
 * @package Heartbits\Contao\BackendTheme\Listener
 */
class HookListener
{
    /**
     * Contao Framework.
     *
     * @var ContaoFramework
     */
    private $framework;

    /**
     * HookListener constructor.
     *
     * @param ContaoFramework $framework Contao Framework.
     */
    public function __construct(ContaoFramework $framework)
    {
        $this->framework = $framework;
    }

    /**
     * Set the default backend theme.
     *
     * @return void
     */
    public function setDefaultBackendTheme()
    {
        /** @var Config $config */
        $config = $this->framework->getAdapter(Config::class);
        $config->set('backendTheme', 'heart-bits');
    }
}
