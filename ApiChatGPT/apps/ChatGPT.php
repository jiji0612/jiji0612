<?php
require __DIR__ . '/../vendor/autoload.php';

use Orhanerday\OpenAi\OpenAi;

class ChatGPT extends Line_Apps
{
    private $open_ai_key = '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';
    private $open_ai;

    function getapi_owner(){
        return new OpenAi($this->open_ai_key);
    }

    function on_follow()
    {
        return "Hi!";
    }

    function on_message($message)
    {
        try {
            $text = $message['text'];
            $ai = isset($_SESSION["ai"]) ? $_SESSION["ai"] : $this->getapi_owner();
            $_SESSION["ai"] = $ai;
            $complete = $ai->completion([
                'model' => 'text-davinci-003',
                'prompt' => $text,
                'temperature' => 0.9,
                'max_tokens' => 150,
                'frequency_penalty' => 0,
                'presence_penalty' => 0.6,
            ]);

            $rets = json_decode($complete, true);
            //$ret = $rets["choices"][0]["text"];
            // $ret = preg_replace("@\n@", " ", $ret);
            // $ret = preg_replace('/[^A-Za-z0-9\-]/', ' ', $ret);

            $messages = array();
            $messages[] = array('type' => 'text', 'text' => '"' . $rets . '"');
            return $messages;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
