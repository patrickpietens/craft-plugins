<?php

namespace Craft;

class YoutubePlugin extends BasePlugin
{
    public function addTwigExtension() {
        Craft::import('plugins.youtube.twigextensions.YoutubeTwigExtension');
        return new YoutubeTwigExtension();
    }

    function getName() {
         return Craft::t('Youtube');
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