<?php

use \Codebuster\ContaoOpenaiBundle\Controller\ContentElement\ChatbotController;

$strName = 'tl_content';

$GLOBALS['TL_DCA']['tl_content']['palettes'][ChatbotController::TYPE] = "{type_legend},type;chatbot_title,chatbot_customCSS;{invisible_legend:hide},invisible,start,stop";

$GLOBALS['TL_DCA'][$strName]['fields']['chatbot_title'] = [
    'label' => &$GLOBALS['TL_LANG'][$strName]['chatbot_title'],
    'exclude' => true,
    'inputType' => 'text',
    'eval' => ['tl_class'=>'w50', 'maxlength'=>255],
    'sql' => "varchar(255) NOT NULL default ''",
];

$GLOBALS['TL_DCA'][$strName]['fields']['chatbot_customCSS'] = [
    'label' => &$GLOBALS['TL_LANG'][$strName]['chatbot_customCSS'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => ['tl_class'=>'w50'],
    'sql' => ['type' => 'boolean', 'default' => false],
];