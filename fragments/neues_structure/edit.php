<?php

use FriendsOfRedaxo\NeuesStructure\Entry;

// Formular ausgeben

$articleId = rex_request('article_id', 'int');
$categoryId = rex_request('category_id', 'int');
$clang_id = rex_request('clang', 'int');
$ctype_id = rex_request('ctype', 'int');
$neues_entry_id = rex_request('neues_entry_id', 'int');

$category = rex_category::getCurrent();
$category_id = $category->getId();
$clang_id = $category->getClangId();
$neues_entry_id = rex_request('neues_entry_id', 'int');

$context = new rex_context([
    'page' => rex_be_controller::getCurrentPage(),
    'article_id' => $articleId,
    'category_id' => $categoryId,
    'neues_entry_id' => $neues_entry_id,
    'clang' => $clang_id,
    'ctype' => $ctype_id,
]);

$entry = Entry::query()->where('id', $neues_entry_id)->findOne();
if ($entry === null) {
    $entry = Entry::create();
}

$yform = $entry->getForm();
$yform->setObjectparams('form_action', rex_url::backendController(['page' => 'content/neues_structure', 'category_id' => $category_id, 'article_id' => $articleId, 'clang' => $clang_id, 'ctype' => $ctype_id, 'neues_entry_id' => $neues_entry_id], false));
$yform->setObjectparams('form_id', 'neues_structure');
$yform->setObjectparams('form_name', 'neues_structure');
$yform->setObjectparams('real_field_names', true);

$yform->setObjectparams('form_showformafterupdate', 1);

if ($entry->exists() === true) {
    $yform->setObjectparams('main_table', $entry->getTablename());
    $yform->setObjectparams('main_id', $entry->getId());
    $yform->setObjectparams('main_where', 'id = ' . $neues_entry_id);
    $yform->setObjectparams('getdata', true);
    $yform->setActionField('db', [$entry->getTableName(), 'id = ' . $neues_entry_id]);
} else {
    $yform->setActionField('db', [$entry->getTableName()]);
}

$fragment = new rex_fragment();
$fragment->setVar('class', 'edit', false);
$fragment->setVar('title', rex_i18n::msg('neues_structure.edit.title'), false);
$fragment->setVar('body', $yform->getForm(), false);

echo $fragment->parse('core/page/section.php');
