<?php

namespace Heartbits\ContaoBackendTheme\EventListener;

use Contao\System;
use Contao\Backend;
use Contao\BackendUser;
use Contao\CoreBundle\Event\MenuEvent;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class BackendMenuListener
{
    protected $router;
    protected $requestStack;

    public function __construct(RouterInterface $router, RequestStack $requestStack)
    {
        $this->router = $router;
        $this->requestStack = $requestStack;
    }

    public function onBuild(MenuEvent $event): void
    {
        $theme = Backend::getTheme();
        if ($theme === 'heart-bits' || $theme === 'saschawustmann') {
            $objUser = BackendUser::getInstance();
            $factory = $event->getFactory();
            $tree = $event->getTree();

            if ('headerMenu' !== $tree->getName() ) {
                return;
            }

            $support = $factory
                ->createItem('support')
                ->setLabel($GLOBALS['TL_LANG'][$theme]['need_help'])
                ->setAttribute('class', 'submenu support')
                ->setLabelAttribute('class', 'h2')
            ;

            $tree->addChild($support);

            $name = $factory
                ->createItem('info')
                ->setLabel('<strong>' . $GLOBALS['TL_LANG'][$theme]['title'] . '</strong>' . $GLOBALS['TL_LANG'][$theme]['phone'])
                ->setAttribute('class', 'info')
                ->setExtra('safe_label', true)
            ;

            $support->addChild($name);

            $website = $factory
                ->createItem('website')
                ->setLabel($GLOBALS['TL_LANG'][$theme]['website'])
                ->setUri($GLOBALS['TL_LANG'][$theme]['website_link'])
                ->setLinkAttribute('class', 'icon-link')
                ->setExtra('safe_label', true)
            ;

            $support->addChild($website);

            $email = $factory
                ->createItem('email')
                ->setLabel($GLOBALS['TL_LANG'][$theme]['send_email'])
                ->setUri($GLOBALS['TL_LANG'][$theme]['email'])
                ->setLinkAttribute('class', 'icon-email')
                ->setExtra('safe_label', true)
            ;

            $support->addChild($email);

            if ($objUser->isAdmin && System::getContainer()->getParameter('kernel.environment') == 'dev') {
                $tree->reorderChildren(['support', 'manual', 'alerts', 'preview', 'submenu', 'burger']);
            } elseif ($objUser->isAdmin) {
                $tree->reorderChildren(['support', 'manual', 'alerts', 'debug', 'preview', 'submenu', 'burger']);
            } else {
                $tree->reorderChildren(['support', 'manual', 'alerts', 'preview', 'submenu', 'burger']);
            }
        }
    }
}