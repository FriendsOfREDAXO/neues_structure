<?php

use FriendsOfRedaxo\NeuesStructure\Entry;

$neues_entry_id = rex_get('neues_entry_id', 'int', null);

if($neues_entry_id !== null) {
    $fragment = new rex_fragment();
    $fragment->setVar('neues_entry_id', $neues_entry_id);
    return $fragment->parse('neues_structure/edit.php');
} else {

    $entries = Entry::query()->where('neues_structure_article_id', rex_article::getCurrentId())->find();

    $fragment = new rex_fragment();
    $fragment->setVar('entries', $entries);
    return $fragment->parse('neues_structure/list.php');
}
