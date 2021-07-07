<?php
/**
 * MonstersRepository
 */
declare(strict_types=1);

namespace App\Model\Repository;

use App\Datastore\Datastore;
use App\Model\Entity\Monster;

class MonstersRepository implements RepositoryInterface
{
    /**
     * @var \App\Datastore\Datastore
     */
    private Datastore $datastore;

    /**
     * @var \App\Model\Entity\Monster
     */
    private $entityClass;

    /**
     * MonstersRepository constructor.
     */
    public function __construct(Datastore $datastore)
    {
        $this->datastore = $datastore;
        $this->entityClass = Monster::class;
    }

    /**
     * Find a list of all the Monsters in the datastore
     *
     * @return array
     */
    public function findAll(): array
    {
        $result = $this->datastore->query(
            'SELECT
                        monsters.id AS id,
                        monsters.name AS monster_name,
                        monsters.species_id AS monster_species_id,
                        species.id AS species_id,
                        species.name AS species_name
                    FROM
                        monsters
                        JOIN species
                    WHERE
                        species.id = monsters.species_id'
        );

        if ($result instanceof \SQLite3Result === false) {
            return [];
        }

        $resultArray = [];
        while($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $resultArray[] = new $this->entityClass($row);
        }

        return $resultArray;
    }
}
