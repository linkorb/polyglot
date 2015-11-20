<?php

namespace Polyglot\ConfigLoader;

use Symfony\Component\Yaml\Parser;
use Polyglot\Config;

class YamlConfigLoader
{
    public function load($filename)
    {
        $config = new Config();
        $yaml = new Parser();
        $data = $yaml->parse(file_get_contents($filename));
        if (!isset($data['path'])) {
            throw new RuntimeException("Path not configured");
        }
        if (!isset($data['locales'])) {
            throw new RuntimeException("Locales not configured");
        }
        $config->setPath($data['path']);
        foreach ($data['locales'] as $l) {
            $config->addLocale((string)$l);
        }
        return $config;
    }
}
