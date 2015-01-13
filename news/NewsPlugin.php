<?php

namespace Craft;

class NewsPlugin extends BasePlugin
{
    public function addTwigExtension() {
        Craft::import('plugins.news.twigextensions.NewsTwigExtension');
        return new NewsTwigExtension();
    }

    function getName() {
         return Craft::t('News');
    }

    function getVersion() {
        return '1.0';
    }

    function getDeveloper() {
        return 'Patrick Pietens';
    }

    function getDeveloperUrl() {
        return 'http://patrickpietens.com';
    }
}