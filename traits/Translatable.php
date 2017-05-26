<?php

namespace rgen3\tickets\traits;

use rgen3\tickets\exceptions\InvalidTranslationKeyException;
use rgen3\tickets\interfaces\Translation;

trait Translatable
{
    private $translations;

    private function getTranslationModelId()
    {
        $reflection = new \ReflectionClass($this);

        $shortClassId = $reflection->getShortName();

        return sprintf('%sTranslation', $shortClassId);
    }

    public function setTranslations(array $translations)
    {
        foreach ($translations as $lang => $translation)
        {
            $this->pushTranslation($lang, $translation);
        }
    }

    public function pushTranslation($lang, Translation $translation)
    {
        $this->translations[$lang] = $translation;
    }

    public function getTranslation($lang = null)
    {
        if (is_null($lang))
        {
            return $this->translations;
        }

        if (!array_key_exists($lang, $this->translations))
            throw new InvalidTranslationKeyException();

        return $this->translations[$lang];
    }

    public function getTranslationModel($language = null, $initiate = false)
    {
        if (is_null($language))
        {
            $language = \Yii::$app->language;
        }

        $translationModel = $this->getTranslationModelId();

        $model = $translationModel::findOne(['language_code' => $language, 'offer_id' => $this->id]);

        if (!$model && $initiate)
        {
            $model = new $translationModel();
        }

        return $model;
    }
}