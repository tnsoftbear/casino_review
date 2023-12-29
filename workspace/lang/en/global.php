<?php
$domainName = 'Casino.lv';
$siteTitle = "{$domainName} - No secrets anymore";
$twitterAccount = '@TwitterAccount';
$siteDescription = "Discover the world of online casinos with {$domainName}. Expert reviews, game insights, and responsible gambling guides await. Stay informed for a safer and more enjoyable gaming experience";

return [
    'site_title' => $siteTitle,
    'site_description' => $siteDescription,
    'meta.twitter.title' => $siteTitle,
    'meta.twitter.description' => $siteDescription,
    'meta.twitter.site' => $twitterAccount,
    'meta.twitter.creator' => $twitterAccount,
    
    'meta.og.title' => $siteTitle,
    'meta.og.description' => $siteDescription,
    'meta.og.site_name' => $domainName,
];
