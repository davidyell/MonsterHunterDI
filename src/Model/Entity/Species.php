<?php
/**
 * Species
 *
 * Copyright (c) 2021 Comparison Technologies Ltd.
 *
 * @author David Yell <david.yell@comparisontech.com>
 */
declare(strict_types=1);

namespace App\Model\Entity;

use JsonSerializable;

class Species implements JsonSerializable
{
    /**
     * @var array
     */
    private array $data;

    /**
     * Species constructor.
     *
     * @param array $data Property data to create entity
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function id(): string
    {
        return $this->data['id'];
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->data['name'];
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4
     */
    public function jsonSerialize()
    {
        return $this->data;
    }
}
