<?php

/**
 * @copyright Copyright 2022 Michael Joyce
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GNU GPLv3
 */
class GchPlugin extends Omeka_Plugin_AbstractPlugin {
    protected $_hooks = [
        'install',
        'uninstall',
    ];

    protected $_filters = [
        'item_citation',
    ];

    protected $_options = [];

    public function hookInstall() {
        $this->_installOptions();
    }

    public function hookUninstall() {
        $this->_uninstallOptions();
    }

    public function filterItemCitation($citation, $args) {
        // Creator, 'Title' (Description), date, Collection, Grassroots Chinese History Archive, URL.
        $item = $args['item'];
        $creator = metadata($item, ['Dublin Core', 'Creator']) ?: "Unknown";
        $title = metadata($item, ['Dublin Core', 'Title']) ?: "Untitled";
        $description = metadata($item, ['Dublin Core', 'Description']) ?: 'No description provided';
        $date = metadata($item, ['Dublin Core', 'Date']) ?: "Undated";
        $collection = metadata($item, 'collection_name') ?: 'No collection';
        $siteTitle = option('site_title');
        $url = metadata($item, 'permalink');

        return sprintf('%s, "%s" (%s), %s, %s, %s, %s', $creator, $title, $description, $date, $collection, $siteTitle, $url);
    }

}
