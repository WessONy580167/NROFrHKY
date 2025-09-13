<?php
// 代码生成时间: 2025-09-14 05:17:13
class DatabasePoolManager {
    /**
     * @var array Pool of database connections.
     */
    private $connectionPool = [];

    /**
     * @var array Configuration for the database connection.
     */
    private $config = [];

    /**
     * Constructor
     *
     * @param array $config Database configuration.
     */
    public function __construct($config) {
        $this->config = $config;
    }

    /**
     * Get a connection from the pool.
     * If a connection is available in the pool, it is returned.
     * If no connection is available, a new connection is created and added to the pool.
     *
     * @return mysqli
     */
    public function getConnection() {
        if (!empty($this->connectionPool)) {
            // Return the first available connection from the pool.
            return array_shift($this->connectionPool);
        } else {
            // Create a new connection and add it to the pool.
            $connection = new mysqli(
                $this->config['hostname'],
                $this->config['username'],
                $this->config['password'],
                $this->config['database']
            );

            // Check for connection error.
            if ($connection->connect_error) {
                throw new Exception('Connection failed: ' . $connection->connect_error);
            }

            // Add the new connection to the pool.
            $this->connectionPool[] = $connection;

            return $connection;
        }
    }

    /**
     * Release a connection back to the pool.
     *
     * @param mysqli $connection The connection to release.
     */
    public function releaseConnection($connection) {
        // Close any active statement before returning the connection to the pool.
        if ($connection->stmt_init() && $connection->more_results()) {
            $connection->next_result();
        }

        // Return the connection to the pool.
        array_push($this->connectionPool, $connection);
    }

    /**
     * Close all connections in the pool.
     */
    public function closeAllConnections() {
        while (!empty($this->connectionPool)) {
            $connection = array_shift($this->connectionPool);
            $connection->close();
        }
    }
}
