<?php

namespace Jean\GraphqlInputs\Inputs;

use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\DataTransferObject;

class Connect extends DataTransferObject
{
    public int $id;

    public function toArray(): array
    {
        return [
            'connect' => $this->id,
        ];
    }
}
