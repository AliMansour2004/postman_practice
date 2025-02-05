<?php

class db
{

    private ?PDO $connection = null;

    // this function is called everytime this class is instantiated

    /**
     * @throws Exception
     */
    public function __construct($DB_HOST, $DB_NAME, $DB_USERNAME, $DB_PASSWORD)
    {

        try {

            $this->connection = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;", $DB_USERNAME, $DB_PASSWORD);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

    }

    // Insert a row/s in a Database Table

    /**
     * @throws Exception
     */
    public function Insert($statement = "", $parameters = []): false|string
    {
        try {

            $this->executeStatement($statement, $parameters);
            return $this->connection->lastInsertId();

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    // Select a row/s in a Database Table

    /**
     * @throws Exception
     */
    public function Select($statement = "", $parameters = []): false|array
    {
        try {

            $stmt = $this->executeStatement($statement, $parameters);
            return $stmt->fetchAll();

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function Select1row($sql)
    {
        $q = $this->connection->prepare($sql);
        $q->execute();
        return $q->fetchColumn();
    }
//    public function Select1row0($statement = "")
//    {
//        try {
//            $sth = $this->connection->prepare("$statement");
//            $sth->execute();
//
//            print "Fetch the first column from the first row in the result set:\n";
//            $result = $sth->fetchColumn();
//            print "$result";
//            return " ";
//
////            print "Fetch the second column from the second row in the result set:\n";
////            $result = $sth->fetchColumn(1);
////            print "colour = $result\n";
////            $stmt = $this->executeStatement( $statement);
////            return $stmt->fetch(\PDO::FETCH_ASSOC, \PDO::FETCH_ORI_FIRST);
//        } catch (Exception $e) {
//            throw new Exception($e->getMessage());
//        }
//    }

    // Update a row/s in a Database Table
    /**
     * @throws Exception
     */
    public function Update($statement = "", $parameters = []): void
    {
        try {

            $this->executeStatement($statement, $parameters);

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    // Remove a row/s in a Database Table

    /**
     * @throws Exception
     */
    public function Remove($statement = "", $parameters = []): void
    {
        try {

            $this->executeStatement($statement, $parameters);

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function LastInsertId(): false|string
    {
        return $this->connection->lastInsertId();
    }

    // execute statement

    /**
     * @throws Exception
     */
    private function executeStatement($statement = "", $parameters = []): false|PDOStatement
    {
        try {

            $stmt = $this->connection->prepare($statement);
            $stmt->execute($parameters);
            return $stmt;

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

}