<?php

namespace FriendsOfRedaxo\NeuesStructure;

use FriendsOfRedaxo\Neues\Entry as NeuesEntry;
use rex_article;

class Entry extends NeuesEntry
{
    public static function addContentTab()
    {
        \rex_extension::register('PAGES_PREPARED', function () {
            if(\rex_article::getCurrent()->isStartArticle() === false) {
                return;
            }
            $page = new \rex_be_page('neues_structure', \rex_i18n::msg('neues_structure.tab.title'));
            $page->setPjax(false);
            $page->setSubPath(\rex_addon::get('neues_structure')->getPath('pages/tab.php'));
            $page_controller = \rex_be_controller::getPageObject('content');
            $page->setItemAttr('class', "pull-left");
            $page_controller->addSubpage($page);
        });
    }
    public function getBackendEditUrl() {
        $rex_article = rex_article::get($this->getValue('neues_structure_article_id'));
        if($rex_article === null) {
            return '';
        }
        return \rex_url::backendPage('content/neues_structure', ['article_id' => $rex_article->getId(), 'clang' => $rex_article->getClang(), 'neues_entry_id' => $this->getId()]);
    }
}
