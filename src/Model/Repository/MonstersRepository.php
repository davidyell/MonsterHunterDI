<?php
/**
 * MonstersRepository
 */
declare(strict_types=1);

namespace App\Model\Repository;

use App\Datastore\Datastore;
use App\Model\Entity\Monster;
use App\Model\Entity\Species;

class MonstersRepository implements RepositoryInterface
{
    /**
     * @var \App\Datastore\Datastore
     */
    private Datastore $datastore;

    /**
     * MonstersRepository constructor.
     */
    public function __construct()
    {
        $this->datastore = new Datastore();
        $this->entityClass = Monster::class;
    }

    /**
     * Find a list of all the Monsters in the datastore
     *
     * @return array|Monster[]
     */
    public function findAll(): array
    {
        $query = 'SELECT
                        monsters.id AS id,
                        monsters.name AS monster_name,
                        species.id AS species_id,
                        species.name AS species_name
                    FROM
                        monsters
                        JOIN species
                    WHERE
                        species.id = monsters.species_id';

        $statement = $this->datastore->prepare($query);
        $result = $statement->execute();

        if ($result instanceof \SQLite3Result === false) {
            $statement->close();
            return [];
        }

        $resultArray = [];
        while($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $monster = new Monster([
                'id' => $row['id'],
                'name' => $row['monster_name'],
                'species' => new Species([
                    'id' => $row['species_id'],
                    'name' => $row['species_name']
                ])
            ]);

            $resultArray[] = $monster;
        }

        $statement->close();
        return $resultArray;
    }

    /**
     * Find a single monster
     *
     * @param int $id Id of the monster
     * @return \App\Model\Entity\Monster|null
     */
    public function findOne(int $id): ?Monster
    {
        $query = 'SELECT
                        monsters.id AS id,
                        monsters.name AS monster_name,
                        species.id AS species_id,
                        species.name AS species_name
                    FROM
                        monsters
                        JOIN species
                    WHERE
                        species.id = monsters.species_id AND monsters.id = :id';

        $statement = $this->datastore->prepare($query);
        $statement->bindValue(':id', $id, SQLITE3_INTEGER);

        $result = $statement->execute();

        if ($result instanceof \SQLite3Result === false) {
            $statement->close();
            return null;
        }

        $row = $result->fetchArray(SQLITE3_ASSOC);

        $monster = new Monster([
            'id' => $row['id'],
            'name' => $row['monster_name'],
            'species' => new Species([
                'id' => $row['species_id'],
                'name' => $row['species_name']
            ])
        ]);

        return $monster;
    }
}
