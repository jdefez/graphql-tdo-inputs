<?php

namespace Jean\GraphqlInputs\examples;

use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\DataTransferObject;

class CommiteeUserInput extends DataTransferObject
{
    #[MapTo('commitee_id')]
    public int $id;

    public string $role;

    public string $matricule;
}

