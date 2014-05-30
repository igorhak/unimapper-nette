<?php

namespace UniMapper\Nette\Api;

class RepositoryContainer
{
    private $repositories = [];

    public function registerRepository(\UniMapper\Repository $repository)
    {
        $this->repositories[$repository->getName()] = $repository;
    }

    public function getRepositoryByName($name)
    {
        return $this->repositories[$name];
    }

}