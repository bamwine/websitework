<?php
/**
 * The FormCreate Plugin Class is created by Roy N Kusemererwa
 * This is an open Source Plugin and requires no payment
 * Enjoy
 */

class formCreate extends SM {


    /**
     * @param $table
     * @param $data
     * @param $pdo
     * This is a generic function to be used in  inserting data
     * It can be accessed by saying
     * $table = "accounts";
     * $data = array("fname"=> "ahmed", "lastname"=> "Roy");
     *
     * insert($table, $data, $pdo)
     */
    public function form_insert ($table, $data)
    {
        foreach ($data AS $column => $value)
        {
            $sql = "INSERT INTO {$table} ({$column}) VALUES(:{$column});";
            $stmt = self::runQuery($sql);
            $stmt->execute(array(':'.$column => $value));

        }
    }
    
}