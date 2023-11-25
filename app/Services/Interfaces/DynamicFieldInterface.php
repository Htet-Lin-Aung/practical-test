<?php

namespace App\Services\Interfaces;

interface DynamicFieldInterface
{
    public function fieldList();

    public function createField($request);
}
