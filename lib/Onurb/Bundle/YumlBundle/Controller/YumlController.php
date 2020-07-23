<?php

namespace Onurb\Bundle\YumlBundle\Controller;

use Psr\Container\ContainerInterface;
use Onurb\Bundle\YumlBundle\Yuml\YumlClient;
use Onurb\Bundle\YumlBundle\Yuml\YumlClientInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

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
    /** @var YumlClient $yumlClient */
    protected $yumlClient;

    public function __construct(YumlClientInterface $yumlClient)
    {
        $this->yumlClient = $yumlClient;
    }

    public function getParameter(string $name)
    {
        return $this->container->getParameter($name);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function indexAction()
    {
        $showDetailParam    = $this->getParameter('onurb_yuml.show_fields_description');
        $colorsParam        = $this->getParameter('onurb_yuml.colors');
        $notesParam         = $this->getParameter('onurb_yuml.notes');
        $styleParam         = $this->getParameter('onurb_yuml.style');
        $extensionParam     = $this->getParameter('onurb_yuml.extension');
        $directionParam     = $this->getParameter('onurb_yuml.direction');
        $scale              = $this->getParameter('onurb_yuml.scale');

        return $this->redirect(
            $this->yumlClient->getGraphUrl(
                $this->yumlClient->makeDslText($showDetailParam, $colorsParam, $notesParam),
                $styleParam,
                $extensionParam,
                $directionParam,
                $scale
            )
        );
    }
}
