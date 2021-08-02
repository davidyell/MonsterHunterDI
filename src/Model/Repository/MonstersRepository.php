<?php
/**
 * MonstersRepository
 */
declare(strict_types=1);

namespace App\Model\Repository;

use App\Datastore\Datastore;
use App\Model\Entity\Monster;
use App\Model\Entity\Species;
use Monolog\Logger;
use Psr\Log\LoggerAwareTrait;

class MonstersRepository implements RepositoryInterface
{
    use LoggerAwareTrait;

    /**
     * @var \App\Datastore\Datastore
     */
    private Datastore $datastore;

    /**
     * MonstersRepository constructor.
     *
     * @param \App\Datastore\Datastore $datastore
     */
    public function __construct(Datastore $datastore, Logger $logger)
    {
        $this->datastore = $datastore;
        $this->setLogger($logger);
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
                        monsters.image AS monster_image,
                        species.id AS species_id,
                        species.name AS species_name
                    FROM
                        monsters
                        JOIN species
                    WHERE
                        species.id = monsters.species_id';

        $statement = $this->datastore->prepare($query);
        $result = $statement->execute();

        if ($result->fetchArray() === false) {
            $this->logger->warning('Finding monsters returned no results', [$statement->getSQL(true)]);
            $statement->close();
            return [];
        }

        $resultArray = [];
        $result->reset();
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $monster = new Monster([
                'id' => $row['id'],
                'name' => $row['monster_name'],
                'image' => $row['monster_image'],
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
                        monsters.image AS monster_image,
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

        if ($result->fetchArray() === false) {
            $this->logger->warning('Finding a monster returned no results', ['id' => $id]);
            $statement->close();
            return null;
        }

        $result->reset();
        $row = $result->fetchArray(SQLITE3_ASSOC);

        $monster = new Monster([
            'id' => $row['id'],
            'name' => $row['monster_name'],
            'image' => $row['monster_image'],
            'species' => new Species([
                'id' => $row['species_id'],
                'name' => $row['species_name']
            ])
        ]);

        $statement->close();
        return $monster;
    }
}
