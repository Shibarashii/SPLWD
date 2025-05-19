<?php

use PHPUnit\Framework\TestCase;

class MockMysqliResult {
    private $data;
    private $index = 0;

    public function __construct($data) {
        $this->data = $data;
    }

    public function fetch_row() {
        if ($this->index < count($this->data)) {
            return $this->data[$this->index++];
        }
        return null;
    }
}

class MockMysqli {
    private $results;

    public function __construct($results = []) {
        $this->results = $results;
    }

    public function query($sql) {
        return new MockMysqliResult($this->results[$sql] ?? []);
    }
}

class ConvertTest extends TestCase
{
    private $conn;

    protected function setUp(): void
    {
        $this->conn = new MockMysqli([
            "SHOW TABLES" => [
                ['users'],
                ['products'],
                ['orders']
            ]
        ]);
    }

    public function testTableRetrievalSuccess()
    {
        $tables = [];
        $result = $this->conn->query("SHOW TABLES");
        while ($row = $result->fetch_row()) {
            $tables[] = $row[0];
        }

        // Expected tables
        $expectedTables = ['users', 'products', 'orders'];

        // Assertions
        $this->assertEquals($expectedTables, $tables, "The retrieved table names should match the expected list.");
        $this->assertCount(3, $tables, "There should be exactly 3 tables retrieved.");
    }

    public function testEmptyTableList()
    {
        $emptyConn = new MockMysqli([
            "SHOW TABLES" => []
        ]);

        $tables = [];
        $result = $emptyConn->query("SHOW TABLES");
        while ($row = $result->fetch_row()) {
            $tables[] = $row[0];
        }

        // Assertions
        $this->assertEmpty($tables, "The table list should be empty when no tables exist.");
    }
}
?>