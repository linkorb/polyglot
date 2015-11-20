<?php

namespace Polyglot;

class Config
{
    private $path;
    
    public function getPath()
    {
        return $this->path;
    }
    
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }
    
    private $locales = array();
    
    public function addLocale($locale)
    {
        $this->locales[] = $locale;
        return $this;
    }
    
    public function getLocales()
    {
        return $this->locales;
    }
    
}
