<?php

namespace Codebuster\ContaoOpenaiBundle\Controller;

use Codebuster\ContaoOpenaiBundle\Classes\ChatHandler;
use Contao\BackendUser;
use Contao\Config;
use Contao\System;
use Contao\Input;
use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Terminal42\ServiceAnnotationBundle\Annotation\ServiceTag;

#[Route('/_chat', name: ChatController::class, defaults: ['_scope' => 'frontend', '_token_check' => false])]
class ChatController
{
    public function __invoke(Request $request): Response
    {
        $this->listen();

        return new Response('', Response::HTTP_OK);
    }

    public function listen() {

        $requestMethod = $_SERVER['REQUEST_METHOD'];

        if ($requestMethod === 'POST') {
            $postData = file_get_contents("php://input");
            $decodedData = json_decode($postData, true);

            $strRole = Config::get('chatbot_role_prompt');

            $arrRole = [
                "role" => "system",
                "content" => $strRole
            ];
            array_unshift($decodedData['messages'],$arrRole);

            if ($decodedData && isset($decodedData['messages'])) {
                $response = $this->sendMessageToGPT4($decodedData['messages']);
                $this->sendResponse($response);
            } else {
                $this->sendError('Invalid message data');
            }
        } else {
            $this->sendError('Invalid request');
        }
    }

    private function sendMessageToGPT4($messages) {

        $endpoint = Config::get('chatbot_endpoint');
        if($endpoint == 'OpenAI') {
            $apiUrl = 'https://api.openai.com/v1/chat/completions';
            $model = 'gpt-4';
        } else if($endpoint === 'Custom') {
            $apiUrl = Config::get('chatbot_endpoint_custom');
            $model = Config::get('chatbot_model_custom');
        }

        $data = [
            'model' => $model,
            'messages' => $messages,
        ];

        $token = Config::get('gpt_token');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $token
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            return 'API Error: ' . curl_error($ch);
        }

        curl_close($ch);

        $response = json_decode($result, true);
        if (isset($response['choices'][0]['message']['content'])) {
            return $response['choices'][0]['message']['content'];
        } else {
            return "No response received."; // Sie könnten auch prüfen, ob ein spezifischer Fehler vorliegt.
        }
    }

    private function sendResponse($reply) {
        header('Content-Type: application/json');
        echo json_encode(['reply' => $reply]);
    }

    private function sendError($error) {
        header('Content-Type: application/json');
        header('HTTP/1.1 400 Bad Request');
        echo json_encode(['error' => $error]);
    }
}