<?php

namespace App\Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// storage facades
use Illuminate\Support\Facades\Storage;
use App\Traits\HasUuid;

class BaseModel extends Model
{
    /**
     * Export current nutrition_facts rows to a JSON backup file (e.g. before schema changes).
     */
    public static function saveBackup(): string
    {
        $data = static::all()->map(fn (self $row) => $row->getAttributes());
        $modelName = strtolower(class_basename(static::class));
        $basePath = 'table_backups/';
        $path = $basePath . $modelName . '_' . now()->format('Y-m-d_His') . '.json';
        Storage::disk('private')->makeDirectory($basePath);
        Storage::disk('private')->put($path, json_encode($data->values()->all(), JSON_PRETTY_PRINT));

        return $path;
    }

    /**
     * Import backup data into the model.
     */
    public static function importBackup(string $path): void
    {
        $data = json_decode(Storage::disk('private')->get($path), true);
        foreach ($data as $item) {
            static::firstOrCreate($item);
        }
    }
}