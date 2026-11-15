<?php

namespace App\Support;

class Selection
{
    /** @return int[]|null Prázdny výber je platný, null označuje chybný vstup. */
    public static function ids(mixed $values, array $allowedIds): ?array
    {
        if ($values === null) {
            return [];
        }
        if (!is_array($values)) {
            return null;
        }

        $ids = [];
        foreach ($values as $value) {
            if (!is_string($value)) {
                return null;
            }
            $id = filter_var($value, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
            if ($id === false || !in_array($id, $allowedIds, true)) {
                return null;
            }
            $ids[] = $id;
        }

        return array_values(array_unique($ids));
    }
}
