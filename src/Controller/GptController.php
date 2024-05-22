<?php

namespace Codebuster\ContaoOpenaiBundle\Controller;

use Contao\BackendUser;
use Contao\Config;
use Contao\System;
use Contao\Input;
use Codebuster\ContaoOpenaiBundle\Classes\GptClass;
use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Terminal42\ServiceAnnotationBundle\Annotation\ServiceTag;

#[Route('/_gpt', name: GptController::class, defaults: ['_scope' => 'backend', '_token_check' => true])]
class GptController
{
    public function __invoke(Request $request): Response
    {

        $container = System::getContainer();
        $blnBackend = $container->get('contao.security.token_checker')->hasBackendUser();
        $strContent = "";
        if ($blnBackend === false) {
            return new Response('Bad Request', Response::HTTP_BAD_REQUEST);
        }

        $strMode = Input::get('mode');

        if(Input::get('id')) {
            $intPage = Input::get('id');
            $strContent = GptClass::prepareContent($intPage);
        }

        $response = $this->doRequest($strMode,$strContent);

        return new Response($response,Response::HTTP_OK);
    }

    private function doRequest(string $mode, string $content): string {

        $strReturn = "";
        $arrReturn = [];
        $strPrompt = "";
        $arrPost = [];
        $token = Config::get('gpt_token');
        $endpoint = Config::get('gpt_endpoint');

        if($token) {

            if($mode == 'title') {
                $strPrompt = Config::get('gpt_title_prompt');
            } else if($mode == 'description') {
                $strPrompt = Config::get('gpt_desc_prompt');
            } else if($mode == 'tinymce') {
                $strPrompt = Input::get('prompt');
            }

            if($endpoint == 'Complete') {
                $strUrl = 'https://api.openai.com/v1/completions';
                $arrPost = [
                    "model" => Config::get('gpt_model_complete'),
                    "prompt" => $strPrompt." ".$content,
                    "max_tokens" => Config::get('gpt_max_tokens'),
                    "temperature" => Config::get('gpt_temp')
                ];
            } else if($endpoint == 'Chat') {
                $strUrl = 'https://api.openai.com/v1/chat/completions';
                $strRole = Config::get('gpt_role_prompt');
                $arrPost = [
                    "model" => Config::get('gpt_model_chat'),
                    "messages" => [
                        [
                            "role" => "system",
                            "content" => $strRole
                        ],
                        [
                            "role" => "user",
                            "content" => $strPrompt . " " . $content,
                        ]
                    ],
                    "max_tokens" => Config::get('gpt_max_tokens'),
                    "temperature" => Config::get('gpt_temp')
                ];
            } else if($endpoint == 'Custom') {
                $strUrl = Config::get('gpt_endpoint_custom');
                $strRole = Config::get('gpt_role_prompt');
                $arrPost = [
                    "model" => Config::get('gpt_custom_model'),
                    "messages" => [
                        [
                            "role" => "system",
                            "content" => $strRole
                        ],
                        [
                            "role" => "user",
                            "content" => $strPrompt . " " . $content
                        ]
                    ],
                    "max_tokens" => Config::get('gpt_max_tokens'),
                    "temperature" => Config::get('gpt_temp')
                ];
            }

            $client = new Client();
            $headers = [
                "Content-Type" => "application/json"
            ];
            if($token) {
                $headers["Authorization"] = "Bearer $token";
            }
            $body = json_encode($arrPost);
            $request = new \GuzzleHttp\Psr7\Request('POST', $strUrl, $headers,$body);
            $res = $client->sendAsync($request)->wait();

            $content = json_decode($res->getBody()->getContents());

            if(isset($content->error)) {
                $arrReturn = [
                    "content" => $content->error->message,
                    "success" => false
                ];
            } else {
                if($endpoint == 'Complete') {
                    $strReturn = $content->choices[0]->text;
                } else if($endpoint == 'Chat') {
                    $strReturn = $content->choices[0]->message->content;
                } else if($endpoint == 'Custom') {
                    $strReturn = $content->choices[0]->message->content;
                }

                $arrReturn = [
                    "content" => str_replace('"','',trim(preg_replace('/\s+/', ' ', $strReturn))),
                    "success" => true
                ];
            }

            $strReturn = json_encode($arrReturn);
        }

        return $strReturn;
    }
}