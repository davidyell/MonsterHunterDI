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

class Species
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
}
