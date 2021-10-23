<?php

namespace Jean\GraphqlInputs\examples;

use Jean\GraphqlInputs\Inputs\CreateCollectionCaster;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\DataTransferObject;
use Jean\GraphqlInputs\examples\MandateInput;

class UserInput extends DataTransferObject
{
    #[MapFrom('user_firstname')]
    public string $firstname;

    #[MapFrom('user_lastname')]
    public string $lastname;

    #[MapFrom('user_email')]
    #[EmailValidator()]
    public string $email;

    #[MapTo('mandates')]
    #[CastWith(CreateCollectionCaster::class, MandateInput::class)]
    public ?array $createMandates;

    public function toArray(): array
    {
        return [
            'input' => parent::toArray(),
        ];
    }
}
