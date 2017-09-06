<?php

/**
 * @package    contao-backend-theme
 * @author     heart-bits <hi@heart-bits.com>
 * @copyright  2017 heart-bits Sascha Wustmann. All rights reserved.
 * @filesource
 *
 */

namespace Heartbits\ContaoBackendTheme;

class Handbook extends \BackendModule
{
    protected $strTemplate = 'be_handbook_list';


    public function compile()
    {
        if (TL_MODE == 'BE')
        {
            $this->import('BackendUser', 'User');

            $this->Template->request = ampersand($this->Environment->request, true);
        }
    }
}