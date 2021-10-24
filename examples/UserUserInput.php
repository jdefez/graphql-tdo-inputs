<?php

namespace Jean\GraphqlInputs\examples;

use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\DataTransferObject;

class UserUserInput extends DataTransferObject
{
    #[MapTo('manager_id')]
    public int $id;
}

