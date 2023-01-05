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
            $open_ai = new OpenAi('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', 'SoftYs');
            $complete = $open_ai->completion([
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
            $messages[] = array('type' => 'text', 'text' => '"' . $complete . '"');
            return $messages;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
