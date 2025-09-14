<?php
// 代码生成时间: 2025-09-14 18:12:48
class DatabasePoolManager {
    /**
     * @var array An array of database connections.
     */
    private $connections = [];

    /**
     * @var array Configuration for the database connections.
     */
    private $config = [];

    /**
     * DatabasePoolManager constructor.
     * Initialize the database configuration.
     *
     * @param array $config Database configuration options.
     */
    public function __construct($config) {
        $this->config = $config;
    }

    /**
     * Connect to the database using the provided configuration.
     *
     * @return mysqli|bool Returns the database connection resource on success, or false on failure.
     */
    private function connect() {
        $connection = mysqli_init();
        if ($connection) {
            // Set connection properties
            $connection->options(MYSQLI_OPT_CONNECT_TIMEOUT, 5);
            $connection->real_connect(
                $this->config['hostname'],
                $this->config['username'],
                $this->config['password'],
                $this->config['database']
            );
            if ($connection->connect_error) {
                // Handle connection error
                error_log('Connect Error (' . $this->config['hostname'] . '): ' . $connection->connect_error);
                return false;
            }
        }
        return $connection;
    }

    /**
     * Get a database connection from the pool or create a new one if necessary.
     *
     * @return mysqli|bool Returns the database connection resource on success, or false on failure.
     */
    public function getConnection() {
        // Check if the pool already has an open connection
        if (empty($this->connections)) {
            // Create a new connection
            $connection = $this->connect();
            if ($connection) {
                // Add the connection to the pool
                $this->connections[] = $connection;
            }
            return $connection;
        } else {
            // Reuse an existing connection
            $connection = array_shift($this->connections);
            // Re-add the connection to the pool for future use
            $this->connections[] = $connection;
            return $connection;
        }
    }

    /**
     * Release a database connection back to the pool.
     *
     * @param mysqli $connection The database connection to release.
     */
    public function releaseConnection($connection) {
        // Check if the connection is valid
        if ($connection && $connection->ping()) {
            // Return the connection to the pool
            $this->connections[] = $connection;
        } else {
            // Handle the case where the connection is invalid or has timed out
            error_log('Connection is no longer valid and will not be returned to the pool.');
        }
    }

    /**
     * Close all connections in the pool.
     */
    public function closeAll() {
        foreach ($this->connections as $connection) {
            $connection->close();
        }
        $this->connections = [];
    }
}
