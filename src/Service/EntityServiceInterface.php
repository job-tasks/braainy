<?php

namespace App\Service;

interface EntityServiceInterface
{
    public function updateOrCreate(array $array);

    public function sync(array $array);

    public function getAll();

    public function prepareArray(array $array, bool $isNew = false);

    public function updateId(int $id, string $billyId);
}