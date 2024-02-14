<?php

$strTable = "tl_gpt_config";

$GLOBALS["TL_LANG"][$strTable] = [
    "config_legend"         => "General settings",
    "contao_legend"         => "Contao settings",
    "gptseo_legend"         => "GPTSEO settings",
    "gpt_hidden_elements"   => ["Include hidden elements","Aktivate to include hidden elements."],
    "gpt_custom_fields"     => ["Custom fields","Select additional table fields. IMPORTANT: Serialized content is not yet supported."],
    "gpt_token"             => ["OpenAI Token","Enter the token here - <a href='https://platform.openai.com/account/api-keys' target='_blank' style='font-weight:bold;'>Generate tokens here</a>"],
    "gpt_endpoint"          => ["GPT Model"],
    "gpt_model_chat"        => ["GPT Chat completion Model","Take a look at the models and their functions at <a href='https://platform.openai.com/playground?mode=chat' target='_blank' style='font-weight:bold;'>Playground</a>."],
    "gpt_model_complete"    => ["GPT Completion Model","Take a look at the models and their functions at <a href='https://platform.openai.com/playground?mode=complete' target='_blank' style='font-weight:bold;'>Playground</a>."],
    "gpt_title_prompt"      => ["SEO-Title prompt","Enter the prompt for title generation here."],
    "gpt_desc_prompt"       => ["SEO-Description prompt","Enter the prompt for description generation here."],
    "gpt_temp"              => ["temperature","The sampling temperature, between 0 and 1. Higher values like 0.8 will make the output more random, while lower values like 0.2 will make it more focused and deterministic. If set to 0, the model will use log probability to automatically increase the temperature until certain thresholds are hit."],
    "gpt_max_tokens"        => ["max_tokens","The maximum number of tokens to generate in the chat completion. The total length of input tokens and generated tokens is limited by the models context length."]
];