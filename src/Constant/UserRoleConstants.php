<?php

namespace App\Constant;

/**
 * Class UserRoleConstants.
 */
class UserRoleConstants extends BaseConstants
{
    const ROLE_USER = 'ROLE_USER';
    const ROLE_ADMIN = 'ROLE_ADMIN';
    const ROLE_EDITOR = 'ROLE_EDITOR';

    const CHOICES = [
        self::ROLE_USER => 'Viewer',
        self::ROLE_ADMIN => 'Admin',
        self::ROLE_EDITOR => 'Editor',
    ];
}
