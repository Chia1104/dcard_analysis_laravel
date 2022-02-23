<?php

namespace App\Dcard\Services;

use App\Dcard\Repositories\DcardRepository;

class DcardService
{
    private DcardRepository $dcardRepo;

    public function __construct(DcardRepository $dcardRepo) {
        $this -> dcardRepo = $dcardRepo;
    }

    public function getDcard() {
        return $this -> dcardRepo -> getDcard();
    }
}
