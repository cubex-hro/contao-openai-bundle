<?php

$strTable = "tl_gpt_config";

$GLOBALS["TL_LANG"][$strTable] = [
    "config_legend"         => "Allgemeine Einstellungen",
    "contao_legend"         => "Contao Einstellungen",
    "gptseo_legend"         => "GPTSEO Einstellungen",
    "gpt_hidden_elements"   => ["Ausgeblendete Elemente berücksichtigen","Anhaken um auch ausgeblendete Elemente mit einzubeziehen."],
    "gpt_custom_fields"     => ["Benutzerdefinierte Felder","Weitere Tabellen-Felder auswählen. WICHTIG: Serialisierter Inhalt wird noch nicht unterstützt."],
    "gpt_token"             => ["OpenAI Token","Tragen Sie hier den Token ein - <a href='https://platform.openai.com/account/api-keys' target='_blank' style='font-weight:bold;'>Hier Token generieren</a>"],
    "gpt_endpoint"          => ["GPT Model"],
    "gpt_model_chat"        => ["GPT Chat completion Model","Sehen Sie sich die Models und deren Funktion im <a href='https://platform.openai.com/playground?mode=chat' target='_blank' style='font-weight:bold;'>Playground</a> an."],
    "gpt_model_complete"    => ["GPT Completion Model","Sehen Sie sich die Models und deren Funktion im <a href='https://platform.openai.com/playground?mode=complete' target='_blank' style='font-weight:bold;'>Playground</a> an."],
    "gpt_title_prompt"      => ["SEO-Titel prompt","Tragen Sie hier das Prompt für die Titelgenerierung ein."],
    "gpt_desc_prompt"       => ["SEO-Beschreibung prompt","Tragen Sie hier das Prompt für die Beschreibungsgenerierung ein."],
    "gpt_temp"              => ["temperature","The sampling temperature, between 0 and 1. Higher values like 0.8 will make the output more random, while lower values like 0.2 will make it more focused and deterministic. If set to 0, the model will use log probability to automatically increase the temperature until certain thresholds are hit."],
    "gpt_max_tokens"        => ["max_tokens","The maximum number of tokens to generate in the chat completion. The total length of input tokens and generated tokens is limited by the models context length."]
];