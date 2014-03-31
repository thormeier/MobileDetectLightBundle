<?php

namespace Thormeier\MobileDetectLightBundle\Twig;

use Detection\MobileDetect;

/**
 * Class for mobile detection wrapping
 */
class MobileDetectExtension extends \Twig_Extension
{
    /**
     * @var MobileDetect
     */
    private $mobileDetector;

    /**
     * Class for mobile detection wrapping
     *
     * @param MobileDetect $mobileDetector
     */
    public function __construct(MobileDetect $mobileDetector)
    {
        $this->mobileDetector = $mobileDetector;
    }

    /**
     * @codeCoverageIgnore
     *
     * @return string
     */
    public function getName()
    {
        return 'mobile_detect_lightweight';
    }

    /**
     * @codeCoverageIgnore
     *
     * @return array
     */
    public function getFunctions()
    {
        return array(
            'is_mobile'  => new \Twig_Function_Method($this, 'isMobile'),
            'is_tablet'  => new \Twig_Function_Method($this, 'isTablet'),
            'is_desktop' => new \Twig_Function_Method($this, 'isDesktop'),
        );
    }

    /**
     * @return bool
     */
    public function isMobile()
    {
        return $this->mobileDetector->isMobile();
    }

    /**
     * @return bool
     */
    public function isTablet()
    {
        return $this->mobileDetector->isTablet();
    }

    /**
     * @return bool
     */
    public function isDesktop()
    {
        return false === $this->isMobile() && false === $this->isTablet();
    }
} 