<?php

use src\Integration\DataProviderConcrete;
use src\Decorator\CacheDataProviderDecorator;

$dataProvider = new DataProviderConcrete('localhost', 'user', 'password');
$cacheDataProvider = new CacheDataProviderDecorator($dataProvider, $cacheItemPool, $logger);

$cacheDataProvider->fetchDataByParameterList([]);