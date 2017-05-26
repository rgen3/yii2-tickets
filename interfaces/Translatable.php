<?php

namespace rgen3\tickets\interfaces;

interface Translatable
{
    public function getTranslationModel($language = null, $initiate = false);
}