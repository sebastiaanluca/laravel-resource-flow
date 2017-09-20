<?php

namespace SebastiaanLuca\Flow\Models;

use Carbon\Carbon;

trait BooleanDates
{
    /**
     * Set the date of fields to the current date and time if a counterpart boolean field is
     * true-ish.
     *
     * Keys and values should be in the format: `'boolean_field' => 'internal_timestamp_field'`.
     *
     * @var array
     */
    protected $booleanDates = [];

    /**
     * Set a given attribute on the model.
     *
     * @param  string $key
     * @param  mixed $value
     *
     * @return $this
     */
    public function setAttribute(string $key, $value)
    {
        if ($this->hasBooleanDate($key)) {
            $this->attributes[$this->getBooleanDateField($key)] = $this->getBooleanDateValue($value);

            return $this;
        }

        return parent::setAttribute($key, $value);
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    public function hasBooleanDate(string $key) : bool
    {
        return in_array($key, array_keys($this->booleanDates));
    }

    /**
     * @param $key
     *
     * @return string
     */
    public function getBooleanDateField($key) : string
    {
        return $this->booleanDates[$key];
    }

    /**
     * @param $value
     *
     * @return string|null
     */
    public function getBooleanDateValue($value) : ?string
    {
        return $value ? $this->fromDateTime(Carbon::now()) : null;
    }
}
