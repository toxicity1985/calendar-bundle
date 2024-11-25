<?php

namespace ADesigns\CalendarBundle\Tests\Fixtures\App;

use ADesigns\CalendarBundle\ADesignsCalendarBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function getRootDir(): string
    {
        return __DIR__;
    }

    public function registerBundles(): iterable
    {
        $bundles = array();

        $bundles[] = new FrameworkBundle();
        $bundles[] = new ADesignsCalendarBundle();

        return $bundles;
    }

    public function getCacheDir(): string
    {
        return sys_get_temp_dir().'/'.Kernel::VERSION.'/adesigns-calendar-bundle/cache/'.$this->environment;
    }
    public function getLogDir(): string
    {
        return sys_get_temp_dir().'/'.Kernel::VERSION.'/adesigns-calendar-bundle/logs';
    }

    public function registerContainerConfiguration(LoaderInterface $loader): void
    {
        $loader->load(__DIR__.'/config.yml');
    }
}