<?php
/**
 * Created by PhpStorm.
 * User: dungnt
 * Date: 10/8/15
 * Time: 8:36 PM
 */

namespace App\Http\Controllers\Frontend;

use App\Funny\Models\Post;
use App\Funny\Repositories\Contracts\PostRepositoryInterface;
use DOMDocument;

class CrawlerController extends FrontendController
{
    private $post;

    public function __construct(PostRepositoryInterface $postRepositoryInterface)
    {
        parent::__construct();
        $this->post = $postRepositoryInterface;
    }

    public function getCrawler()
    {

    }

    public function postCrawler()
    {
        $input = $this->input();
        $url = $input['url'];

        $ch = curl_init();

        // Now set some options (most are optional)

        // Set URL to download
        curl_setopt($ch, CURLOPT_URL, $url);

        // Set a referer
        curl_setopt($ch, CURLOPT_REFERER, "http://www.example.org/yay.htm");

        // User agent
        curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");

        // Include header in result? (0 = yes, 1 = no)
        curl_setopt($ch, CURLOPT_HEADER, 0);

        // Should cURL return or print out the data? (true = return, false = print)
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Timeout in seconds
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        // Download the given URL, and return output
        $output = curl_exec($ch);

        // Close the cURL resource, and free system resources
        curl_close($ch);
        $dom = new \Symfony\Component\DomCrawler\Crawler($output);
        $listVideo = $dom->filter('div.videoList > div.videoListItem > div.thumb a.play')->children();
        foreach ($listVideo as $li) {
            $name = $li->getAttribute('alt');
            $src = $li->getAttribute('src');

        }
    }
}