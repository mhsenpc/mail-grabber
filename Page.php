<?php
include_once("curl.php");
include_once("patterns.php");

class Page {

    /**
     * @var string
     */
    private $url;

    public function __construct(string $url) {
        $this->url = $url;
    }

    public function fetch(): PageResponse {
        $response = new PageResponse();


        //download page
        $page = Curl_download($this->url);

        //first part: save emails
        preg_match_all(EMAIL_PATTERN, $page, $emails);
        $response->emails = $emails[0];

        //then find links in page and crawl them too
        preg_match_all(URL_PATTERN, $page, $urls);
        $response->urls = $urls[0];


        return $response;
    }
}