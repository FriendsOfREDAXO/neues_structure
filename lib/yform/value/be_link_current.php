<?php

class rex_yform_value_be_link_current extends rex_yform_value_be_link
{
    public function enterObject()
    {
        // prüfe, ob rex_backend_page "content" ist
        $content = rex_be_controller::getCurrentPagePart() && rex_be_controller::getCurrentPagePart()[0] == "content";
        if (rex_article::getCurrentId() && $content) {
            $this->setValue(rex_article::getCurrentId());
            $this->params['value_pool']['email'][$this->getName()] = $this->getValue();
            if ($this->saveInDB()) {
                $this->params['value_pool']['sql'][$this->getName()] = $this->getValue();
            }
        } else {
            parent::enterObject();
        }
    }

    public function getDefinitions(): array
    {
        return [
            'type' => 'value',
            'name' => 'be_link_current',
            'values' => [
                'name' => ['type' => 'name',   'label' => rex_i18n::msg('yform_values_defaults_name')],
                'label' => ['type' => 'text',   'label' => rex_i18n::msg('yform_values_defaults_label')],
                'multiple' => ['type' => 'checkbox',   'label' => rex_i18n::msg('yform_values_be_link_multiple')],
                'notice' => ['type' => 'text',    'label' => rex_i18n::msg('yform_values_defaults_notice')],
            ],
            'description' => rex_i18n::msg('yform_values_be_link_description'),
            'formbuilder' => false,
            'db_type' => ['text', 'varchar(191)', 'int'],
        ];
    }
}
