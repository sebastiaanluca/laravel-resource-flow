<?php

namespace SebastiaanLuca\Flow\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    /**
     * Fill the model with an array of attributes. Does not set data if the model already has data
     * for it.
     *
     * @param array $attributes
     *
     * @return $this
     *
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    public function fillIfMissing(array $attributes)
    {
        $attributes = collect($attributes)
            ->reject(function ($attribute, $field) {
                return in_array($field, $this->attributes);
            })
            ->all();

        return $this->fill($attributes);
    }
}
