<?php

namespace App\Service;

interface  EntityServiceInterface
{
    public function getOrCreate(array $array);
}