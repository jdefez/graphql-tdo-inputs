<?php

namespace Jean\GraphqlInputs\examples;

use Jean\GraphqlInputs\Inputs\CreateCollectionCaster;
use Jean\GraphqlInputs\Inputs\SyncCollectionCaster;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\DataTransferObject;

class UserInput extends DataTransferObject
{
    #[MapFrom('firstname')]
    public string $firstname;

    #[MapFrom('lastname')]
    public string $lastname;

    #[MapFrom('email')]
    #[EmailValidator()]
    public string $email;

    #[MapTo('mandates')]
    #[CastWith(CreateCollectionCaster::class, MandateInput::class)]
    public ?array $createMandates;

    #[MapTo('managers')]
    #[CastWith(SyncCollectionCaster::class, UserUserInput::class)]
    public ?array $syncManagers;

    #[MapTo('commitees')]
    #[CastWith(SyncCollectionCaster::class, CommiteeUserInput::class)]
    public ?array $syncCommitees;

    public function toArray(): array
    {
        return [
            'input' => parent::toArray(),
        ];
    }
}
