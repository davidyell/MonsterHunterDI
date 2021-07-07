<?php
/**
 * Monster
 */
declare(strict_types=1);

namespace App\Model\Entity;

class Monster
{
    /**
     * @var array Internal entity data
     */
    private $data;

    /**
     * Monster constructor.
     *
     * @param array $data Array of data to build the entity
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return int
     */
    public function id(): int
    {
        return (int)$this->data['id'];
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->data['name'];
    }

    /**
     * @return Species
     */
    public function species(): Species
    {
        return $this->data['species'];
    }
}
