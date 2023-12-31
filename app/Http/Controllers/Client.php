<?php
namespace Acme;

use Symfony\Component\BrowserKit\AbstractBrowser;
use Symfony\Component\BrowserKit\Response;


class Client extends AbstractBrowser
{
    protected function doRequest($request): Response
    {
        // ... convert request into a response

        // return new Response($content, $status, $headers);
        return new Response($request->all());
    }
}
?>