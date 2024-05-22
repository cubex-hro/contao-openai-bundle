<?php

declare(strict_types=1);

/*
 * This file is part of Contao.
 *
 * (c) Leo Feyer
 *
 * @license LGPL-3.0-or-later
 */

namespace Codebuster\ContaoOpenaiBundle\Controller\ContentElement;

use Contao\ContentModel;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsContentElement;
use Contao\FrontendTemplate;
use Contao\System;
use Contao\Template;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsContentElement(ChatbotController::TYPE,category: 'openai-bundle', template:ChatbotController::TEMPLATE)]
class ChatbotController extends AbstractContentElementController
{
    public const TYPE = 'ce_chatbot';
    public const TEMPLATE = 'ce_chatbot';

    protected function getResponse(Template $template, ContentModel $model, Request $request): Response
    {

        if($model->chatbot_title) {
            $template->title = $model->chatbot_title;
        } else {
            $template->title = 'AI Chatbot';
        }

        if(!$model->chatbot_customCSS) {
            $GLOBALS["TL_CSS"]["contaoopenai-chatbot"] = "/bundles/contaoopenai/chatbot.css";
        }

        return $template->getResponse();
    }
}
