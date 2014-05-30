<?php

namespace UniMapper\Nette\Api;

use UniMapper\Repository,
    Nette\Application\Routers\RouteList,
    Nette\Application\Routers\Route;

class RouterFactory extends RouteList
{

    public static function create(Repository $repository, $prefix)
    {
        $router = new RouteList;
        $router[] = new Route($prefix . "/" . $repository->getName() . "/<id>", $repository->getName() . ":" . "findOne");
        $router[] = new Route($prefix . "/" . $repository->getName(), $repository->getName() . ":" . "findAll");
        return $router;
    }

}