<?php


class Crawler {
    protected string $url;
    protected $outputEmails = false;
    protected $saveEmails = false;
    protected $printer;

    /**
     * @param Printer $printer
     */
    public function setPrinter(Printer $printer): void {
        $this->printer = $printer;
    }

    /**
     * @param Disk $saver
     */
    public function setSaver(Disk $saver): void {
        $this->saver = $saver;
    }

    protected $saver;

    public function __construct(string $url) {
        $this->url = $url;
        $this->printer = new Printer();
        $this->saver = new Disk('emails/'.time() . 'txt');
    }

    /**
     * @param bool $outputEmails
     */
    public function setOutputEmails(bool $outputEmails): void {
        $this->outputEmails = $outputEmails;
    }

    /**
     * @param bool $saveEmails
     */
    public function setSaveEmails(bool $saveEmails): void {
        $this->saveEmails = $saveEmails;
    }


    public function crawl() {
        $allEmails = [];
        $page = new Page($this->url);
        $mainPageResponse = $page->fetch();
        $allEmails = array_merge($allEmails, $mainPageResponse->emails);

        if ($this->outputEmails) {
            $this->printer->output($allEmails);
        }

        if ($this->saveEmails) {
            $this->saver->saveMails($allEmails);
        }
    }
}