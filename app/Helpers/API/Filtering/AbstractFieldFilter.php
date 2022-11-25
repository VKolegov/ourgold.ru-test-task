<?php

namespace App\Helpers\API\Filtering;

abstract class AbstractFieldFilter implements FieldFilter
{
    protected string $field;
    protected string $fieldType;

    protected const FIELD_TYPES = ['int', 'string', 'date'];

    /**
     * @param string $field database column name
     * @param string $fieldType possible values: 'int', 'string', 'date'
     */
    public function __construct(string $field, string $fieldType)
    {
        $this->field = $field;

        if (!in_array($fieldType, static::FIELD_TYPES)) {
            throw new \InvalidArgumentException("invalid \$fieldType: $fieldType");
        }
        $this->fieldType = $fieldType;
    }
}
