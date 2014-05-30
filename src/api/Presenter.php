<?php

namespace UniMapper\Nette\Api;

use Nette\Application\Responses\JsonResponse,
    UniMapper\Nette\Api\RepositoryContainer;

abstract class Presenter extends \Nette\Application\UI\Presenter
{

    /** @var \UniMapper\Nette\Api\RepositoryContainer */
    protected $repositoryContainer;

    public function __construct(RepositoryContainer $repositoryContainer)
    {
        $this->repositoryContainer = $repositoryContainer;
    }

    public function actionFindAll($limit = 0, $offset = 0)
    {
        $query = $this->repositoryContainer->getRepositoryByName($this->getName())->query()->findAll();

        if ($limit) {
            $query->limit($limit);
        }

        if ($offset) {
            $query->offset($offset);
        }

        $this->sendJsonData($query->execute()->toArray(true));
    }

    public function actionFindOne($id)
    {
        $this->sendJsonData($this->repositoryContainer->getRepositoryByName($this->getName())->query()->findOne($id)->execute()->toArray(true));
    }

    public function sendJsonData($data)
    {
        $this->sendResponse(new JsonResponse($data));
    }

}