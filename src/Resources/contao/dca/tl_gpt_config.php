<?php

/**
 * File tl_gpt_config
 */

use Codebuster\ContaoOpenaiBundle\Models\ContentElementsModel;
use Contao\Database;
use Contao\DC_File;

$strTable = 'tl_gpt_config';

$GLOBALS['TL_DCA'][$strTable] = [
//Config
    'config' => [
        'dataContainer' => DC_File::class
    ],
    //Palettes
    'palettes' => [
        '__selector__' => ['gpt_endpoint','chatbot_endpoint'],
        'default' => '
            {config_legend},gpt_token;
            {gptsettings_legend},gpt_endpoint,gpt_temp,gpt_max_tokens;
            {gptseo_legend},gpt_title_prompt,gpt_desc_prompt;
            {chatbot_legend},chatbot_endpoint,chatbot_temp,chatbot_max_tokens;
            {contao_legend},gpt_hidden_elements,gpt_custom_fields;'
    ],
    'subpalettes' => [
        'gpt_endpoint_Complete' => 'gpt_model_complete',
        'gpt_endpoint_Chat' => 'gpt_model_chat,gpt_role_prompt',
        'gpt_endpoint_Custom' => 'gpt_model_custom,gpt_endpoint_custom,gpt_role_prompt',
        'chatbot_endpoint_OpenAI' => 'chatbot_openai_endpoint,chatbot_role_prompt',
        'chatbot_endpoint_Custom' => 'chatbot_model_custom,chatbot_endpoint_custom,chatbot_role_prompt'
    ],
    //Fields
    'fields' => [
        'gpt_token' => [
            'label' => &$GLOBALS['TL_LANG'][$strTable]['gpt_token'],
            'inputType' => 'text',
            'eval' => ['tl_class' => 'clr','hideInput' => true]
        ],
        'gpt_endpoint' => [
            'label' => &$GLOBALS['TL_LANG'][$strTable]['gpt_endpoint'],
            'inputType' => 'select',
            'options' => ['Complete', 'Chat', 'Custom'],
            'eval' => ['multiple' => false, 'tl_class' => 'clr w50', 'submitOnChange' => true]
        ],
        'gpt_model_chat' => [
            'label' => &$GLOBALS['TL_LANG'][$strTable]['gpt_model_chat'],
            'inputType' => 'select',
            'options' => ['gpt-3.5-turbo', 'gpt-4'],
            'eval' => ['multiple' => false, 'tl_class' => 'w50']
        ],
        'gpt_model_complete' => [
            'label' => &$GLOBALS['TL_LANG'][$strTable]['gpt_model_complete'],
            'inputType' => 'select',
            'options' => ['gpt-3.5-turbo-instruct'],
            'eval' => ['multiple' => false, 'tl_class' => 'w50']
        ],
        'gpt_model_custom' => [
            'label' => &$GLOBALS['TL_LANG'][$strTable]['gpt_model_custom'],
            'inputType' => 'text',
            'eval' => ['tl_class' => 'clr w50']
        ],
        'gpt_endpoint_custom' => [
            'label' => &$GLOBALS['TL_LANG'][$strTable]['gpt_endpoint_custom'],
            'inputType' => 'text',
            'eval' => ['tl_class' => 'w50']
        ],
        'gpt_title_prompt' => [
            'label' => &$GLOBALS['TL_LANG'][$strTable]['gpt_title_prompt'],
            'inputType' => 'textarea',
            'eval' => ['decodeEntities' => false,'allowHtml' => true, 'preserveTags' => true, 'tl_class' => 'clr']
        ],
        'gpt_role_prompt' => [
            'label' => &$GLOBALS['TL_LANG'][$strTable]['gpt_role_prompt'],
            'inputType' => 'textarea',
            'eval' => ['decodeEntities' => false,'allowHtml' => true, 'preserveTags' => true, 'tl_class' => 'clr']
        ],
        'gpt_desc_prompt' => [
            'label' => &$GLOBALS['TL_LANG'][$strTable]['gpt_desc_prompt'],
            'inputType' => 'textarea',
            'eval' => ['tl_class' => 'clr']
        ],
        'gpt_temp' => [
            'label' => &$GLOBALS['TL_LANG'][$strTable]['gpt_temp'],
            'inputType' => 'text',
            'eval' => ['rgxp'=>'digit', 'maxlength' => 3, 'nospace'=>true,'tl_class' => 'w50']
        ],
        'gpt_max_tokens' => [
            'label' => &$GLOBALS['TL_LANG'][$strTable]['gpt_max_tokens'],
            'inputType' => 'text',
            'eval' => ['rgxp'=>'natural', 'nospace'=>true,'tl_class' => 'w50']
        ],
        'gpt_hidden_elements' => [
            'label' => &$GLOBALS['TL_LANG'][$strTable]['gpt_hidden_elements'],
            'inputType'               => 'checkbox',
            'eval'                    => ['tl_class' => 'clr w50'],
        ],
        'gpt_custom_fields' => [
            'label' => &$GLOBALS['TL_LANG'][$strTable]['gpt_custom_fields'],
            'default' => 'headline',
            'inputType' => 'select',
            'options_callback' => [$strTable,'getContentFields'],
            'eval' => ['multiple' => true, 'chosen'=> true, 'tl_class' => 'w50']
        ],
        // chatbot fields
        'chatbot_endpoint' => [
            'label' => &$GLOBALS['TL_LANG'][$strTable]['chatbot_endpoint'],
            'inputType' => 'select',
            'options' => ['OpenAI', 'Custom'],
            'eval' => ['multiple' => false, 'tl_class' => 'clr w50', 'submitOnChange' => true]
        ],
        'chatbot_model_custom' => [
            'label' => &$GLOBALS['TL_LANG'][$strTable]['gpt_model_custom'],
            'inputType' => 'text',
            'eval' => ['tl_class' => 'clr w50']
        ],
        'chatbot_role_prompt' => [
            'label' => &$GLOBALS['TL_LANG'][$strTable]['gpt_role_prompt'],
            'inputType' => 'textarea',
            'eval' => ['decodeEntities' => false,'allowHtml' => true, 'preserveTags' => true, 'tl_class' => 'clr']
        ],
        'chatbot_endpoint_custom' => [
            'label' => &$GLOBALS['TL_LANG'][$strTable]['gpt_endpoint_custom'],
            'inputType' => 'text',
            'eval' => ['tl_class' => 'w50']
        ],
        'chatbot_temp' => [
            'label' => &$GLOBALS['TL_LANG'][$strTable]['gpt_temp'],
            'inputType' => 'text',
            'eval' => ['rgxp'=>'digit', 'maxlength' => 3, 'nospace'=>true,'tl_class' => 'clr w50']
        ],
        'chatbot_max_tokens' => [
            'label' => &$GLOBALS['TL_LANG'][$strTable]['gpt_max_tokens'],
            'inputType' => 'text',
            'eval' => ['rgxp'=>'natural', 'nospace'=>true,'tl_class' => 'w50']
        ],
    ]
];

class tl_gpt_config extends Contao\Backend {

    public function getContentFields(\Contao\DataContainer $dc) {

        $arrOptions = [];
        $database = Database::getInstance();
        $fields = $database->listFields('tl_content');

        foreach($fields AS $field) {
            if(in_array($field["type"],['text','varchar','mediumtext'])) {
                $arrOptions[$field["name"]] = $field["name"];
            }
        }

        // remove default and unnecessary
        unset($arrOptions["headline"]);
        unset($arrOptions["text"]);
        unset($arrOptions["type"]);
        unset($arrOptions["ptable"]);

        return $arrOptions;
    }
}