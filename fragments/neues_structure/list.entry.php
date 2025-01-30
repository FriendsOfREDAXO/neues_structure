<?php

/** @var rex_fragement $this */
/** @var FriendsOfRedaxo\NeuesStructure\Entry $entry */
$entry = $this->getVar('entry');
?>
<tr>
    <td><?= $entry->getId() ?></td>
    <td><?= $entry->getName() ?></td>
    <td><?= $entry->getStatus() ?></td>
    <td><?= $entry->getPublishdate() ?></td>
    <td>
        <a href="<?= $entry->getBackendEditUrl() ?>">Bearbeiten</a>
    </td>
</tr>
