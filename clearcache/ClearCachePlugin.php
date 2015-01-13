<?php
namespace Craft;

class ClearCachePlugin extends BasePlugin  {
    public function init() {
        parent::init();

        craft()->on('entries.saveEntry', function(Event $event) {
            craft()->templateCache->deleteAllCaches();
        });
    }

    public function getName() {
        return Craft::t('Clear Cache');
    }

    public function getVersion() {
        return '1.0';
    }

    function getDeveloper() {
        return 'Patrick Pietens';
    }

    function getDeveloperUrl() {
        return 'http://patrickpietens.com';
    }
}
