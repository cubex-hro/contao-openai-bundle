<?php

namespace Codebuster\ContaoOpenaiBundle\Classes;

use Contao\ArticleModel;
use Codebuster\ContaoOpenaiBundle\Models\ContentElementsModel;
use Contao\Config;

class GptClass {

    public static function prepareContent($intPage): string
    {
        $strContent = '';
        $blnHidden = false;
        $customFields = [];
        if(Config::get("gpt_hidden_elements") === true) {
            $blnHidden = true;
        }
        if(Config::get("gpt_custom_fields")) {
            $customFields = unserialize(Config::get("gpt_custom_fields"));
        }

        // get contentelements from page
        if($blnHidden) {
            $objArticles = ArticleModel::findBy("pid", $intPage);
        } else {
            $objArticles = ArticleModel::findBy(["pid=?","published=1"], $intPage);
        }

        // get Content from all Articles
        if ($objArticles !== null) {
            foreach ($objArticles as $article) {
                // get content elements from article
                if($blnHidden) {
                    $objContentElements = ContentElementsModel::findBy("pid",$article->id);
                } else {
                    $objContentElements = ContentElementsModel::findBy(["pid=?","invisible!='1'"],$article->id);
                }
                if ($objContentElements !== null) {
                    foreach ($objContentElements as $contentElement) {
                        $headline = unserialize(strip_tags(nl2br($contentElement->headline)));
                        if($headline["value"]) {
                            $strContent .= strip_tags(trim(preg_replace('/\s+/', ' ', $headline["value"]))).' - ';
                        }
                        $strContent .= strip_tags(trim(preg_replace('/\s+/', ' ', $contentElement->text)));
                        if(!empty($customFields)) {
                            foreach($customFields AS $customField) {
                                // dont regard serialized content
                                if(!is_array(unserialize($contentElement->$customField))) {
                                    $strContent .= strip_tags(trim(preg_replace('/\s+/', ' ', $contentElement->$customField)));
                                }
                            }
                        }
                    }
                }
            }
        }
        // Todo: do max chars even smarter
        return $strContent;
    }
}