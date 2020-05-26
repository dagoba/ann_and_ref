<?php


namespace Budget\Service;


use Pimple\Container;

class BudgetService
{
    use ContainerTrait;

    private $validator;

    public function __construct(ValidatorService $validator)
    {
        $this->validator = $validator;
    }

    public function addRecord(string $title, $amount, int $typeId, string $description = null)
    {

        //$title = $this->validator->validate('title', $title);

        //$pdo = $this->getContainer()['db'];

        $pdo = $this->getContainer('db');

        $statement = $pdo->prepare("INSERT INTO budget (title, ammount, type_id, description) VALUES (?, ?, ?, ?)");
        $statement->execute(array($title, $ammount, $type_id, $description));
    }
}