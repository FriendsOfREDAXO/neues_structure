<?php

/** @var rex_fragement $this */
/** @var rex_yform_manager_collection $entries */
$entries = $this->getVar('entries');

// https://blaupause.test/redaxo/index.php?page=content/neues_structure&article_id=1&clang=1&neues_entry_id=402

$backend_url = rex_url::backendPage('content/neues_structure', [
    'article_id' => rex_request('article_id', 'int'),
    'clang' => rex_request('clang', 'int'),
    'neues_entry_id' => 0,
]);

?>
<div class="table-responsive">
<table class="table">
    <thead>
    <tr>
        <th><a href="<?= $backend_url ?>"><i class="rex-icon rex-icon-add"></i></a></th>
        <th>Name</th>
        <th>Status</th>
        <th>Veröffentlichungsdatum</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
        <?php
        if ($entries->count() === 0) {
            echo $this->parse('neues_structure/list.no-entry.php');
        } else {
        foreach ($entries as $entry) {
            $this->setVar('entry', $entry);
            echo $this->parse('neues_structure/list.entry.php');
        }
}
        ?>
    </tbody>
</table>
</div>
