<?php

namespace App\Service;

interface EntityServiceInterface
{
    public function updateOrCreate(array $array);

    public function sync(array $array);
}