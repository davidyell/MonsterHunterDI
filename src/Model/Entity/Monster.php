<?php
/**
 * Monster
 */
declare(strict_types=1);

namespace App\Model\Entity;

use JsonSerializable;

class Monster implements JsonSerializable
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

    /**
     * @return string|null
     */
    public function image(): ?string
    {
        return $this->data['image'];
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
