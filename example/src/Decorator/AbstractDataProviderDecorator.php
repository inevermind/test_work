<?php

namespace src\Decorator;

use src\Integration\DataProviderInterface;

/**
 * Class AbstractDataProviderDecorator
 * @package src\Decorator
 */
abstract class AbstractDataProviderDecorator implements DataProviderInterface
{
    /** @var DataProviderInterface */
    protected $dataProvider;

    /**
     * AbstractDataProviderDecorator constructor.
     * @param DataProviderInterface $dataProvider
     */
    public function __construct(DataProviderInterface $dataProvider)
    {
        $this->dataProvider = $dataProvider;
    }

    /**
     * @param array $parameterList
     * @return array
     */
    public function fetchDataByParameterList(array $parameterList): array
    {
        return $this->dataProvider->fetchDataByParameterList($parameterList);
    }
}