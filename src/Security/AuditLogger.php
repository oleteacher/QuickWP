<?php

namespace Security;

class AuditLogger {
    private $logFile;

    public function __construct($file = 'audit.log') {
        $this->logFile = $file;
    }

    public function log($message) {
        $timestamp = date('Y-m-d H:i:s');
        $logEntry = "[$timestamp] $message\n";
        file_put_contents($this->logFile, $logEntry, FILE_APPEND);
    }

    public function logAction($action, $user) {
        $this->log("User '$user' performed action: '$action'");
    }
}
