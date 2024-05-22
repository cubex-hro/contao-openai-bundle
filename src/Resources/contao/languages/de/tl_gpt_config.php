<?php

$strTable = "tl_gpt_config";

$GLOBALS["TL_LANG"][$strTable] = [
    "config_legend"         => "Allgemeine Einstellungen",
    "contao_legend"         => "Contao Einstellungen",
    "gptsettings_legend"    => "GPT Einstellungen",
    "gptseo_legend"         => "SEO Einstellungen",
    "chatbot_legend"           => "Chatbot Einstellungen",
    "gpt_hidden_elements"   => ["Ausgeblendete Elemente berücksichtigen","Anhaken um auch ausgeblendete Elemente mit einzubeziehen."],
    "gpt_custom_fields"     => ["Benutzerdefinierte Felder","Weitere Tabellen-Felder auswählen. WICHTIG: Serialisierter Inhalt wird noch nicht unterstützt."],
    "gpt_token"             => ["OpenAI Token","Tragen Sie hier den Token ein - <a href='https://platform.openai.com/account/api-keys' target='_blank' style='font-weight:bold;'>Hier Token generieren</a>"],
    "gpt_endpoint"          => ["GPT Model"],
    "gpt_model_chat"        => ["GPT Chat completion Model","Sehen Sie sich die Models und deren Funktion im <a href='https://platform.openai.com/playground?mode=chat' target='_blank' style='font-weight:bold;'>Playground</a> an."],
    "gpt_model_complete"    => ["GPT Completion Model","Sehen Sie sich die Models und deren Funktion im <a href='https://platform.openai.com/playground?mode=complete' target='_blank' style='font-weight:bold;'>Playground</a> an."],
    "gpt_model_custom"      => ["GPT Custom Model","Tragen Sie hier Ihr Custom Model ein z.B.: lmstudio-community/Meta-Llama-3-8B-Instruct-GGUF"],
    "gpt_endpoint_custom"   => ["GPT Custom Endpoint","Tragen Sie hier Ihren Custom Endpoint ein z.B.: http://localhost:1234/v1/chat/completions"],
    "gpt_role_prompt"       => ["GPT Rolle","Tragen Sie hier eine Rolle ein z.b: Antworte ausschließlich in Reihmen"],
    "gpt_title_prompt"      => ["SEO-Titel prompt","Tragen Sie hier das Prompt für die Titelgenerierung ein."],
    "gpt_desc_prompt"       => ["SEO-Beschreibung prompt","Tragen Sie hier das Prompt für die Beschreibungsgenerierung ein."],
    "gpt_temp"              => ["Temperatur","Die Samplingtemperatur liegt zwischen 0 und 1. Höhere Werte wie 0,8 machen die Ausgabe zufälliger, während niedrigere Werte wie 0,2 sie fokussierter und deterministischer machen. Wenn der Wert auf 0 gesetzt ist, verwendet das Modell die Log-Wahrscheinlichkeit, um die Temperatur automatisch zu erhöhen, bis bestimmte Schwellenwerte erreicht werden."],
    "gpt_max_tokens"        => ["maximale Token","Die maximale Anzahl an Token, die beim Chat-Abschluss generiert werden sollen. Die Gesamtlänge der Eingabetokens und generierten Tokens ist durch die Kontextlänge des Modells begrenzt."],
    "chatbot_endpoint"         => ["Chatbot Model"],
    "chatbot_endpoint_custom"  => ["Chatbot Custom Endpoint","Tragen Sie hier Ihren Custom Endpoint ein z.B.: http://localhost:1234/v1/chat/completions"],
    "chatbot_role_prompt"      => ["Chatbot Rolle","Tragen Sie hier eine Rolle ein z.b: Antworte ausschließlich in Reihmen"],
    "chatbot_model_custom"     => ["Chatbot Custom Model","Tragen Sie hier Ihr Custom Model ein z.B.: lmstudio-community/Meta-Llama-3-8B-Instruct-GGUF"]
];