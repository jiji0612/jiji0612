<?php
require __DIR__ . '/../vendor/autoload.php';

use Orhanerday\OpenAi\OpenAi;

$open_ai_key = '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';
$open_ai = new OpenAi($open_ai_key);
$complete = $open_ai->completion([
    'model' => 'text-davinci-003',
    'prompt' => 'ทดสอบ Timeout ของ api',
    'temperature' => 0.9,
    'max_tokens' => 150,
    'frequency_penalty' => 0,
    'presence_penalty' => 0.6,
]);

var_dump($complete);
