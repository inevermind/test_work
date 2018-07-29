<?php

namespace src\Decorator;

use src\Integration\DataProviderInterface;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerInterface;

/**
 * Class CacheDataProviderDecorator
 * @package src\Decorator
 */
class CacheDataProviderDecorator extends AbstractDataProviderDecorator
{
    protected const CACHE_EXPIRE_TIME = 86400;

    /** @var CacheItemPoolInterface */
    protected $cacheItemPool;

    /** @var LoggerInterface */
    protected $logger;

    /**
     * CacheDataProviderDecorator constructor.
     * @param DataProviderInterface $dataProvider
     * @param CacheItemPoolInterface $cacheItemPool
     * @param LoggerInterface|null $logger
     */
    public function __construct(
        DataProviderInterface $dataProvider,
        CacheItemPoolInterface $cacheItemPool,
        LoggerInterface $logger = null
    ) {
        $this->cacheItemPool = $cacheItemPool;
        $this->logger = $logger;

        parent::__construct($dataProvider);
    }

    /**
     * @param LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }

    /**
     * @param CacheItemPoolInterface $cacheItemPool
     */
    public function setCacheItemPool(CacheItemPoolInterface $cacheItemPool): void
    {
        $this->cacheItemPool = $cacheItemPool;
    }

    /**
     * @param array $parameterList
     * @return array
     */
    public function fetchDataByParameterList(array $parameterList): array
    {
        $cacheItem = $this->cacheItemPool->getItem($this->buildCacheKey($parameterList));
        if (!$cacheItem->isHit()) {
            try {
                $cacheItem->set(
                    parent::fetchDataByParameterList($parameterList)
                )->expiresAfter(self::CACHE_EXPIRE_TIME);
            } catch (\Exception $e) {
                $this->logger->error(sprintf('Cache create error: %s', $e->getMessage()));
            }
        }

        return (array) $cacheItem->get();
    }

    /**
     * @param array $parameterList
     * @return string
     */
    protected function buildCacheKey(array $parameterList): string
    {
        return md5(serialize($parameterList));
    }
}