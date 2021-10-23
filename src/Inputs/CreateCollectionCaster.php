<?php

namespace Jean\GraphqlInputs\Inputs;

use Spatie\DataTransferObject\Caster;

class CreateCollectionCaster implements Caster
{
    private string $keyName = 'create';

    public function __construct(
        private array $initialType,
        protected string $itemType
    ) {
    }

    public function cast(mixed $value): array
    {
        return [$this->keyName => $this->list($value)];
    }

    private function list(array $values): ?array
    {
        if (empty($values)) {
            return null;
        }

        return array_map(fn ($value) => new $this->itemType($value), $values);
    }
}
