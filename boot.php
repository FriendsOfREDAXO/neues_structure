<?php

namespace FriendsOfRedaxo\NeuesStructure;

use FriendsOfRedaxo\NeuesStructure\Entry;
use rex;
use rex_addon;
use rex_be_controller;
use rex_yform_manager_dataset;


if (rex_addon::get('yform')->isAvailable() && !rex::isSafeMode()) {
    rex_yform_manager_dataset::setModelClass(
        'rex_neues_entry',
        Entry::class
    );
}



if (\rex::isBackend()) {
if(rex_be_controller::getCurrentPagePart() && rex_be_controller::getCurrentPagePart()[0] == "content") {    
                Entry::addContentTab();
    }
}
