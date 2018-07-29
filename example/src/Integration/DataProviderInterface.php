<?php

namespace src\Integration;

/**
 * Interface DataProviderInterface
 * @package src\Integration
 */
interface DataProviderInterface
{
    /**
     * @param array $parameterList
     * @return array
     */
    public function fetchDataByParameterList(array $parameterList): array;
}

