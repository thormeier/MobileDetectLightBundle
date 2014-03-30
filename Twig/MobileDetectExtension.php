<?php

namespace Thormeier\MobileDetectBundle\Twig;

use Detection\Mobile_Detection;

/**
 * Class for mobile detection wrapping
 */
class MobileDetectExtension extends \Twig_Extension
{
    /**
     * @var Mobile_Detect
     */
    private $mobileDetector;

    /**
     * Class for mobile detection wrapping
     *
     * @param Mobile_Detection $mobileDetector
     */
    public function __construct(Mobile_Detection $mobileDetector)
    {
        $this->mobileDetector = $mobileDetector;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mobile_detect_lightweight';
    }

    /**
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