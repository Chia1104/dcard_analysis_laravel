<?php

namespace App\Dcard\Repositories;

use App\Dcard\Models\Nlp;

class NlpRepository
{
    private Nlp $_nlp;

    public function __construct(Nlp $nlp) {
        $this -> _nlp = $nlp;
    }

    public function getNlp() {
        $nlp = $this -> _nlp
            ->select('Id', 'SA_Score', 'SA_Class')
            ->orderByDesc('Id');
        return $nlp->dcards;
    }
}
