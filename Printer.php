<?php


class Printer {
    public function output(array $emails) {
        foreach ($emails as $email) {
            echo $email . "\n<br/>";
        }
    }
}