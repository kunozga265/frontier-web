<?php
// config/packages/framework.php
use Symfony\Config\FrameworkConfig;

return static function (FrameworkConfig $framework): void {
    $framework->httpClient()
        ->defaultOptions()
            ->maxRedirects(7)
    ;
};
?>