<?php

namespace App\Models;

use Framework\Core\Model;

class Tea extends Model
{
    protected static ?string $tableName = 'teas';

    public const CATEGORIES = [
        'zelene' => 'Zelené',
        'cierne' => 'Čierne',
        'bylinne' => 'Bylinné',
        'ovocne' => 'Ovocné',
        'rooibos' => 'Rooibos',
    ];

    protected ?int $id = null;
    protected string $name = '';
    protected string $category = '';
    protected string $origin = '';
    protected ?int $weight = null;
    protected string $price = '';
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

    public function getCategory(): string
    {
        return $this->category;
    }

    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

    public function getCategoryLabel(): string
    {
        return self::CATEGORIES[$this->category] ?? $this->category;
    }

    public function getOrigin(): string
    {
        return $this->origin;
    }

    public function setOrigin(string $origin): void
    {
        $this->origin = $origin;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(int $weight): void
    {
        $this->weight = $weight;
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function setPrice(string $price): void
    {
        $this->price = $price;
    }

    public function getFormattedPrice(): string
    {
        return str_replace('.', ',', $this->price);
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
}
