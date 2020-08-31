<?php

namespace Heartbits\ContaoBackendTheme\EventListener;

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
                ->setLabel($GLOBALS['TL_LANG']['heartbits']['need_help'])
                ->setAttribute('class', 'submenu support')
                ->setLabelAttribute('class', 'h2')
            ;

            $tree->addChild($support);

            if ($theme === 'heart-bits') {
                $name = $factory
                    ->createItem('info')
                    ->setLabel('<strong>heart-bits' . $this->theme . '</strong>+49 2261 9158002')
                    ->setAttribute('class', 'info')
                    ->setExtra('safe_label', true)
                ;
            } elseif ($theme === 'saschawustmann') {
                $name = $factory
                    ->createItem('info')
                    ->setLabel('<strong>Sascha Wustmann' . $this->theme . '</strong>+49 2261 9158002')
                    ->setAttribute('class', 'info')
                    ->setExtra('safe_label', true)
                ;
            }

            $support->addChild($name);

            if ($theme === 'heart-bits') {
                $website = $factory
                    ->createItem('website')
                    ->setLabel($GLOBALS['TL_LANG']['heartbits']['website'])
                    ->setUri('https://www.heart-bits.com/')
                    ->setLinkAttribute('class', 'icon-link')
                    ->setExtra('safe_label', true)
                ;
            } elseif ($theme === 'saschawustmann') {
                $website = $factory
                    ->createItem('website')
                    ->setLabel($GLOBALS['TL_LANG']['heartbits']['website'])
                    ->setUri('https://www.saschawustmann.com/')
                    ->setLinkAttribute('class', 'icon-link')
                    ->setExtra('safe_label', true)
                ;
            }

            $support->addChild($website);

            $email = $factory
                ->createItem('email')
                ->setLabel($GLOBALS['TL_LANG']['heartbits']['send_email'])
                ->setUri('mailto:hi@heart-bits.com')
                ->setLinkAttribute('class', 'icon-email')
                ->setExtra('safe_label', true)
            ;

            $support->addChild($email);

            if ($objUser->isAdmin) {
                $tree->reorderChildren(['support', 'alerts', 'debug', 'preview', 'submenu', 'burger']);
            } else {
                $tree->reorderChildren(['support', 'alerts', 'preview', 'submenu', 'burger']);
            }
        }
    }
}