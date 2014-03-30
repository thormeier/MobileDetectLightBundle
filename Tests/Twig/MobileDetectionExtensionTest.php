<?php

namespace Thormeier\MobileDetectBundle\Tests\Twig;

use Thormeier\MobileDetectBundle\Twig\MobileDetectExtension;

/**
 * Test for twig extension
 */
class MobileDetectionExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Detection\MobileDetect
     */
    private $detector;

    /**
     * @var MobileDetectionExtension
     */
    private $extension;

    /**
     * Sets up the extension and a mocked mobile detector
     */
    public function setUp()
    {
        $this->detector = $this->getMockBuilder('Detection\MobileDetect')
            ->disableOriginalConstructor()
            ->setMethods(array('isMobile', 'isTablet'))
            ->getMock();

        $this->extension = new MobileDetectExtension($this->detector);
    }

    /**
     * Test correct return of isMobile
     */
    public function testIsMobile()
    {
        $expectedOutcome = true;

        $this->detector->expects($this->once())
            ->method('isMobile')
            ->will($this->returnValue($expectedOutcome));
        $this->detector->expects($this->never())
            ->method('isTablet');

        $this->assertEquals($expectedOutcome, $this->extension->isMobile());
    }

    /**
     * Test correct return of isMobile
     */
    public function testIsTablet()
    {
        $expectedOutcome = true;

        $this->detector->expects($this->never())
            ->method('isMobile');
        $this->detector->expects($this->once())
            ->method('isTablet')
            ->will($this->returnValue($expectedOutcome));

        $this->assertEquals($expectedOutcome, $this->extension->isTablet());
    }

    /**
     * Tests behaviour of method isDesktop
     *
     * @param bool $mobileOutcome
     * @param bool $tabletOutcome
     *
     * @dataProvider desktopProvider
     */
    public function testIsDesktop($mobileOutcome, $tabletOutcome)
    {
        $expectedOutcome = (!$mobileOutcome && !$tabletOutcome);

        $this->detector->expects($this->once())
            ->method('isMobile')
            ->will($this->returnValue($mobileOutcome));

        // Standard PHP behaviour: if the first check returns false, isTablet is never called
        if (false === $mobileOutcome) {
            $this->detector->expects($this->once())
                ->method('isTablet')
                ->will($this->returnValue($tabletOutcome));
        } else {
            $this->detector->expects($this->never())
                ->method('isTablet');
        }

        $this->assertEquals($expectedOutcome, $this->extension->isDesktop());
    }

    /**
     * DataProvider method for isDesktop tests
     *
     * @return array
     */
    public function desktopProvider()
    {
        return array(
            array(true, false),
            array(false, true),
            array(false, false),
            array(true, true),
        );
    }
} 