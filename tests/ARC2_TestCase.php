<?php

namespace Tests;

use Psr\SimpleCache\CacheInterface;

class ARC2_TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * Store configuration to connect with the database.
     *
     * @var array
     */
    protected $dbConfig;

    /**
     * Subject under test.
     *
     * @var mixed
     */
    protected $fixture;

    public function setUp()
    {
        global $dbConfig;

        $this->dbConfig = $dbConfig;

        // in case we run with a cache, clear it
        if (isset($this->dbConfig['cache_instance']) && $this->dbConfig['cache_instance'] instanceof CacheInterface) {
            $this->dbConfig['cache_instance']->clear();
        }
    }

    public function tearDown()
    {
        // in case we run with a cache, clear it
        if (isset($this->dbConfig['cache_instance']) && $this->dbConfig['cache_instance'] instanceof CacheInterface) {
            $this->dbConfig['cache_instance']->clear();
        }

        parent::tearDown();
    }

    /**
     * Depending on the DB config returns current table prefix. It consists of table prefix and store name, if available.
     *
     * @return string
     */
    protected function getSqlTablePrefix()
    {
        $prefix = isset($this->dbConfig['db_table_prefix']) ? $this->dbConfig['db_table_prefix'].'_' : '';
        $prefix .= isset($this->dbConfig['store_name']) ? $this->dbConfig['store_name'].'_' : '';
        return $prefix;
    }
}
