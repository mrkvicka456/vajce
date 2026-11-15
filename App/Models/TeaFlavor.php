<?php

namespace App\Models;

use Framework\Core\Model;
use Framework\DB\Connection;
use Throwable;

class TeaFlavor extends Model
{
    protected static ?string $tableName = 'tea_flavors';

    protected ?int $id = null;
    protected ?int $tea_id = null;
    protected ?int $flavor_id = null;

    public function getTea(): ?Tea
    {
        return $this->getOneRelated(Tea::class, 'tea_id');
    }

    public function getFlavor(): ?Flavor
    {
        return $this->getOneRelated(Flavor::class, 'flavor_id');
    }

    /** @param int[] $flavorIds */
    public static function saveForTea(Tea $tea, array $flavorIds): void
    {
        self::saveWithLinks($tea, 'tea_id', 'flavor_id', $flavorIds);
    }

    /** @param int[] $teaIds */
    public static function saveForFlavor(Flavor $flavor, array $teaIds): void
    {
        self::saveWithLinks($flavor, 'flavor_id', 'tea_id', $teaIds);
    }

    /** Uloženie entity a všetkých zmien priradení tvorí jednu transakciu. */
    private static function saveWithLinks(Tea|Flavor $entity, string $ownerColumn, string $relatedColumn, array $ids): void
    {
        $connection = Connection::getInstance();
        $connection->beginTransaction();
        try {
            $entity->save();
            $currentIds = [];
            foreach (self::getAll($ownerColumn . ' = ?', [$entity->getId()]) as $relation) {
                $relatedId = $relation->{$relatedColumn};
                if (!in_array($relatedId, $ids, true)) {
                    $relation->delete();
                } else {
                    $currentIds[] = $relatedId;
                }
            }
            foreach (array_unique($ids) as $relatedId) {
                if (!in_array($relatedId, $currentIds, true)) {
                    $relation = new self();
                    $relation->{$ownerColumn} = $entity->getId();
                    $relation->{$relatedColumn} = $relatedId;
                    $relation->save();
                }
            }
            $connection->commit();
        } catch (Throwable $exception) {
            $connection->rollBack();
            throw $exception;
        }
    }
}
