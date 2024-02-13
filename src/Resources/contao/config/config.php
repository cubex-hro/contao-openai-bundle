<?php

/**
 * Back end modules
 */
$GLOBALS['BE_MOD']['gptcontao']['gpt_config'] = array(
    'tables' => array('tl_gpt_config')
);


$GLOBALS['BE_MOD']['design']['page']['gpt_page_seo'] = array('\Codebuster\GptBundle\Classes\GptClass', 'seoModal');