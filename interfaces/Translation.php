<?php

namespace rgen3\tickets\interfaces;

interface Translation
{
    public function getParent();

    public function setLanguage($lang);

    public function getLanguage();
}