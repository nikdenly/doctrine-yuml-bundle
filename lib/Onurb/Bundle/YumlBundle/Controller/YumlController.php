<?php

namespace Onurb\Bundle\YumlBundle\Controller;

use Psr\Container\ContainerInterface;
use Onurb\Bundle\YumlBundle\Yuml\YumlClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Utility to generate Yuml compatible strings from metadata graphs
 * Adaptation of DoctrineORMModule\Yuml\YumlController for ZendFramework-Zend-Developer-Tools
 *
 * @license MIT
 * @link    http://www.doctrine-project.org/
 * @author  Bruno Heron <herobrun@gmail.com>
 * @author  Marco Pivetta <ocramius@gmail.com>
 */
class YumlController extends AbstractController
{
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function indexAction()
    {
        /** @var YumlClient $yumlClient */
        $yumlClient = $this->get('onurb_yuml.client');

        $showDetailParam    = $this->getParameter('onurb_yuml.show_fields_description');
        $colorsParam        = $this->getParameter('onurb_yuml.colors');
        $notesParam         = $this->getParameter('onurb_yuml.notes');
        $styleParam         = $this->getParameter('onurb_yuml.style');
        $extensionParam     = $this->getParameter('onurb_yuml.extension');
        $directionParam     = $this->getParameter('onurb_yuml.direction');
        $scale              = $this->getParameter('onurb_yuml.scale');

        return $this->redirect(
            $yumlClient->getGraphUrl(
                $yumlClient->makeDslText($showDetailParam, $colorsParam, $notesParam),
                $styleParam,
                $extensionParam,
                $directionParam,
                $scale
            )
        );
    }
}
