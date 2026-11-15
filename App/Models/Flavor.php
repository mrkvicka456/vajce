<?php

namespace App\Models;

use Framework\Core\Model;

class Flavor extends Model
{
    protected static ?string $tableName = 'flavors';

    protected ?int $id = null;
    protected string $name = '';
    protected string $description = '';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /** @return Tea[] */
    public function getTeas(): array
    {
        if ($this->id === null) {
            return [];
        }

        $teas = [];
        foreach ($this->getAllRelated(TeaFlavor::class, 'flavor_id') as $relation) {
            $tea = $relation->getTea();
            if ($tea !== null) {
                $teas[] = $tea;
            }
        }

        return $teas;
    }

    /** @param int[] $teaIds */
    public function saveWithTeas(array $teaIds): void
    {
        TeaFlavor::saveForFlavor($this, $teaIds);
    }
}
