<?php

namespace App\Constant;

use Symfony\Component\Form\AbstractType;

/**
 * Class BaseConstants.
 */
abstract class BaseConstants extends AbstractType
{
    /**
     * @return array
     */
    public static function getChoices(): array
    {
        return array_flip(static::CHOICES);
    }
}
