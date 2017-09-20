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
     * Get an attribute from the model.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function getAttribute($key)
    {
        if (! $key) {
            return;
        }

        if ($this->hasBooleanDate($key)) {
            return ! is_null($this->attributes[$this->getBooleanDateField($key)]);
        }

        return parent::getAttribute($key);
    }

    /**
     * Set a given attribute on the model.
     *
     * @param string $key
     * @param mixed $value
     *
     * @return $this
     */
    public function setAttribute($key, $value)
    {
        if ($this->hasBooleanDate($key)) {
            $this->setBooleanDate($key, $value);

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
     * @param string $key
     * @param mixed $value
     */
    public function setBooleanDate(string $key, $value)
    {
        // Only update the timestamp if the value is true and if it's not yet set
        // or if the value is false and we need to unset the field.
        if ($value && $this->currentBooleanDateFieldValueIsNotYetSet($key) || ! $value) {
            $this->attributes[$this->getBooleanDateField($key)] = $this->getNewBooleanDateValue($value);
        }
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    public function currentBooleanDateFieldValueIsNotYetSet(string $key) : bool
    {
        return is_null($this->attributes[$this->getBooleanDateField($key)]);
    }

    /**
     * @param string $key
     *
     * @return string
     */
    public function getBooleanDateField(string $key) : string
    {
        return $this->booleanDates[$key];
    }

    /**
     * @param $value
     *
     * @return string|null
     */
    public function getNewBooleanDateValue($value) : ?string
    {
        return $value ? $this->fromDateTime(Carbon::now()) : null;
    }
}
