<?php

namespace Heartbits\ContaoBackendTheme\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Heartbits\ContaoBackendTheme\Routing\ContaoBackendController;

/**
 * Handles back end routes.
 *
 */
class BackendController extends Controller
{
    /**
     * Renders the main part content
     *
     */
    public function bemainAction()
    {
        return $this->render(
            'HeartbitsContaoBackendThemeBundle::views::Backend::bemain.html.twig',
            [
                'main' => '<br><p>Content from the BE Controller Main Action</p>',
                'link' => '<br><p><a onclick="Backend.openModalIframe({\'width\':780,\'height\':600,\'title\':\'Details\',\'url\':this.href});return false"  
                              href="'.$this->generateUrl('backend_details').'">Link to BE Controller Details Action<a/></p>'
            ]
        );
    }

    /**
     * Renders the details content.
     *
     * @return Response
     *
     */
    public function detailsAction()
    {
        $this->container->get('contao.framework')->initialize();
        $controller = new ContaoBackendController();
        return $controller->run();
    }
}
