<?php
include "Crawler.php";
include "Disk.php";
include "Page.php";
include "PageResponse.php";
include "Printer.php";


if (!isset($_GET['link'])) { ?>
    <form>
        <label for="link">Link to page contain emails</label>
        <input id="link" type="text" name="link"
               placeholder="https://www.infohindihub.in/2021/03/free-bulk-email-id-list-1000-active.html">
        <br/>

        <input id="print_emails" type="checkbox" name="print_emails" value="1">
        <label for="print_emails">Show emails on screen</label>

        <input id="save_emails" type="checkbox" name="save_emails" value="1">
        <label for="save_emails">Save emails on file</label>
        <br/>
        <input type="submit" value="Fetch Emails">
    </form>
<?php } else {
    $crawler = new Crawler($_GET['link']);
    $fileName =  '/emails/'.time() . '.txt';
    $saver = new Disk(__DIR__ .$fileName);
    $crawler->setOutputEmails(isset($_GET['print_emails']));
    $crawler->setSaveEmails(isset($_GET['save_emails']));
    $crawler->setSaver($saver);
    $crawler->crawl();

    if(isset($_GET['save_emails'])){
        echo "<a href='{$fileName}'>Download Emails</a>";
    }
}
?>