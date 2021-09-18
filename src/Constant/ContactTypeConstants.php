<?php

namespace App\Constant;

/**
 * Class ContactTypeConstants.
 */
class ContactTypeConstants extends BaseConstants
{
    const COMPANY = 0;
    const PERSON = 1;

    const CHOICES = [
        self::COMPANY => 'company',
        self::PERSON => 'person',
    ];
}
