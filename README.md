MobileDetectBundle
==================

[![Build Status](https://travis-ci.org/thormeier/MobileDetectBundle.png?branch=master)](https://travis-ci.org/thormeier/MobileDetectBundle)

## Introduction

This Symfony2 bundle provides a few twig functions to check if the client is on a mobile or tablet device. This bundle makes use of the class provided by http://mobiledetect.net/.

## Installation

### Step 1: Composer require

    $ php composer.phar require "thormeier/mobile-detect-bundle":"1.0.*"

### Step2: Enable the bundle in the kernel

    <?php
    // app/AppKernel.php
    
    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Thormeier\MobileDetectBundle\ThormeierMobileDetectBundle(),
            // ...
        );
    }
