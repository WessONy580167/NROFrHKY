<?php
// 代码生成时间: 2025-09-15 08:23:54
class ProcessManager {

    /**
     * @var array Holds the list of processes.
     */
    private $processes = [];

    /**
     * Add a new process to the manager.
     *
     * @param string $command Command to run the process.
     * @param array $environment Environment variables for the process.
     * @return void
     */
    public function addProcess($command, $environment = []) {
        try {
            // Create a new process and add it to the list.
            $process = proc_open($command, [], $pipes, null, $environment);
            if ($process === false) {
                throw new %3aseException('Failed to create process.');
            }
            $this->processes[] = $process;
        } catch (Exception $e) {
            // Handle any exceptions that occur during process creation.
            log_message('error', 'Process creation failed: ' . $e->getMessage());
        }
    }

    /**
     * Check the status of all processes.
     *
     * @return array Returns an array of process statuses.
     */
    public function checkStatus() {
        $statuses = [];
        foreach ($this->processes as $index => $process) {
            $status = proc_get_status($process);
            $statuses[$index] = $status['running'] ? 'Running' : 'Stopped';
        }
        return $statuses;
    }

    /**
     * Terminate all processes.
     *
     * @return void
     */
    public function terminateAll() {
        foreach ($this->processes as $process) {
            proc_terminate($process);
        }
    }

    /**
     * Get output from a specific process.
     *
     * @param int $index Index of the process.
     * @return string Output from the process.
     */
    public function getOutput($index) {
        if (isset($this->processes[$index])) {
            return trim(stream_get_contents($this->processes[$index][1]));
        }
        return 'Process not found.';
    }

    /**
     * Get error output from a specific process.
     *
     * @param int $index Index of the process.
     * @return string Error output from the process.
     */
    public function getErrorOutput($index) {
        if (isset($this->processes[$index])) {
            return trim(stream_get_contents($this->processes[$index][2]));
        }
        return 'Process not found.';
    }
}
