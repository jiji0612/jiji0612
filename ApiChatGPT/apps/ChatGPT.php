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
            $open_ai = new OpenAi("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", "org-R9oUMeKtc3HpcqlSAEBzltwM");
            $complete = $open_ai->completion([
                'model' => "text-davinci-003",
                'prompt' => $text,
                'temperature' => 0.7,
                'max_tokens' => 256,
                'top_p' => 1,
                'frequency_penalty' => 0,
                'presence_penalty' => 0,
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
