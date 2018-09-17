<?php
/**
 * Author: Courtney Miles
 * Date: 26/08/18
 * Time: 8:53 AM
 */

namespace MilesAsylum\Slurp\Load\DatabaseLoader;

use MilesAsylum\Slurp\Load\Exception\MissingValueException;

class BatchInsertManager implements BatchManagerInterface
{
    /**
     * @var \PDO
     */
    protected $pdo;

    /**
     * @var string
     */
    protected $table;

    /**
     * @var array
     */
    protected $columns;

    /**
     * @var QueryFactory
     */
    private $queryFactory;

    /**
     * @var \PDOStatement[]
     */
    private $preparedBatchStmts = [];

    public function __construct(\PDO $pdo, string $table, array $columns, QueryFactory $queryFactory)
    {
        $this->pdo = $pdo;
        $this->table = $table;
        $this->columns = $columns;
        $this->queryFactory = $queryFactory;
    }

    /**
     * @param array[] $rows
     */
    public function write(array $rows)
    {
        if (!empty($rows)) {
            $this->getPreparedBatchStmt(count($rows))
                ->execute(
                    $this->convertRowCollectionToParams($rows)
                );
        }
    }

    protected function getPreparedBatchStmt($count): \PDOStatement
    {
        if (!isset($this->preparedBatchStmts[$count])) {
            $this->preparedBatchStmts[$count] = $this->pdo->prepare(
                $this->queryFactory->createInsertQuery(
                    $this->table,
                    $this->columns,
                    $count
                )
            );
        }

        return $this->preparedBatchStmts[$count];
    }

    protected function ensureColumnMatch($rowId, array $rowValues): void
    {
        $missingFields = array_keys(
            array_diff_key(array_flip($this->columns), $rowValues)
        );

        if (count($missingFields)) {
            throw MissingValueException::createMissing($rowId, $missingFields);
        }
    }

    protected function convertRowCollectionToParams(array $rowCollection):array
    {
        $params = [];

        foreach ($rowCollection as $rowId => $row) {
            $this->ensureColumnMatch($rowId, $row);
            $params = array_merge($params, $this->convertRowToParams($row));
        }

        return $params;
    }

    protected function convertRowToParams($row):array
    {
        $params = [];

        foreach ($this->columns as $col) {
            $params[] = $row[$col];
        }

        return $params;
    }
}