<?php


class Disk {
    private string $path;

    public function __construct(string $path) {
        $this->path = $path;
    }

    public function saveMails(array $emails) {
        file_put_contents($this->path, implode("\n", $emails));
        return true;
    }
}