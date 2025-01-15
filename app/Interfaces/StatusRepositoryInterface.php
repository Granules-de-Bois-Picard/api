<?php

namespace App\Interfaces;

interface StatusRepositoryInterface
{
    public function checkBackofficeStatus();
    public function checkWebsiteStatus();
    public function checkApiStatus();
}
