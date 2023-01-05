<?php
require __DIR__ . '/../vendor/autoload.php';

use Orhanerday\OpenAi\OpenAi;

class ChatGPT extends Line_Apps
{
    function on_follow()
    {
        return "Hi!";
    }

    function on_message($message)
    {
        try {
            $text = $message['text'];

            $open_ai_key = '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';
            $ai = new OpenAi($open_ai_key);

            $complete = $ai->completion([
                'model' => 'text-davinci-003',
                'prompt' => $text,
                'temperature' => 0.9,
                'max_tokens' => 256,
                'frequency_penalty' => 0,
                'presence_penalty' => 0.6,
            ]);

            $rets = json_decode($complete, true);
            //$ret = $rets["choices"][0]["text"];
            // $ret = preg_replace("@\n@", " ", $ret);
            // $ret = preg_replace('/[^A-Za-z0-9\-]/', ' ', $ret);

            $messages = array();
            $messages[] = array('type' => 'text', 'text' => '"' . $complete . '"');
            return $messages;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
