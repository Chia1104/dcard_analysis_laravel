<?php

namespace App\Dcard\Repositories;

use App\Dcard\Models\Dcard;
use Illuminate\Database\Eloquent\Builder;

class DcardRepository
{
    private Dcard $_dcard;

    public function __construct(Dcard $dcard) {
        $this -> _dcard = $dcard;
    }

    public function getDcard(): Builder
    {
        return $this -> _dcard::with(['nlp', 'comparison'])
            ->select('Id', 'Title', 'DateTime', 'CreatedAt', 'Content', 'Topics', 'Tags', 'Gender')
            ->orderByDesc('Id');
    }
}
