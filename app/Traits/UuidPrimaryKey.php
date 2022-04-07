<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait UuidPrimaryKey
{

  /**
   * Access boot and set primary key to UUID
   *
   * @return void
   */
    protected static function bootUuidPrimaryKey()
    {
        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    /**
     * Disable incrementing
     *
     * @return bool
     */
    public function getIncrementing(): bool
    {
        return false;
    }

    /**
     * Model's key type
     *
     * @return string
     */
    public function getKeyType(): string
    {
        return 'string';
    }
}
