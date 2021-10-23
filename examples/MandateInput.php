<?php

namespace Jean\GraphqlInputs\examples;

use Jean\GraphqlInputs\Inputs\Connect;
use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\DataTransferObject;

class MandateInput extends DataTransferObject
{
    #[MapFrom('mandate_name')]
    public string $name;

    #[MapFrom('mandate_credit')]
    public int $credit;

    #[MapFrom('mandate_label')]
    public string $label;

    #[MapTo('mandateDefinition')]
    public Connect $connectMandateDefinition;

    #[MapTo('commitee')]
    public Connect $connectCommitee;
}
