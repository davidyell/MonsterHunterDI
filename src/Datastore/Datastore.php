<?php
declare(strict_types=1);

namespace App\Datastore;

class Datastore extends \SQLite3
{
    /**
     * @var string Name of the database file
     */
    private $filename = __DIR__ . '/monster-hunter.db';

    /**
     * Datastore constructor.
     */
    public function __construct()
    {
        parent::__construct($this->filename);
    }
}
