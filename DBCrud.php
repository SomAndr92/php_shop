<?php

class DBCrud
{

    protected $tabelName;
    protected $db_address; // = "localhost";
    protected $db_user; // = "root";
    protected $db_pass; // = "";
    protected $db_name; // = "testdb";

    public function __construct($tabelName, $db_address, $db_user, $db_pass, $db_name)
    {
        $this->tabelName = $tabelName;
        $this->db_address = $db_address;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_name = $db_name;
    }

    public function Connect()
    {
        $db = @new mysqli($this->db_address, $this->db_user, $this->db_pass, $this->db_name);
        if ($db->connection_errno) {
            echo "error: " . $db->connection_errno;
        } else {
            return $db;
        }
    }

    public function Insert($AssocArray)
    {
        //"INSERT INTO `zoo`(`animal`) VALUES ('$anim')"
        if (!empty($AssocArray)) {

            $ArrayField = [];
            $ArrayValues = [];


            foreach ($AssocArray as $key => $value) {
                array_push($ArrayField, $key);
                array_push($ArrayValues, $value);
            }

            $FieldsStr = implode(",", $ArrayField);
            $FieldsValues = implode(",", $ArrayValues);

            $conn = $this->Connect();
            $query = $conn->query("INSERT INTO `$this->tabelName` (`$FieldsStr`) VALUES ('$FieldsValues')");
            if ($query) {
                echo "ok";
            } else {
                echo "error";
            }


        } else {
            echo "data empty";
        }


    }

    public function Delete($deletItem, $WhereValue)
    {
        if ($deletItem != "" and $WhereValue != "") {
            $conn = $this->Connect();

            //"DELETE FROM `zoo` WHERE `animal` = '$anim';"
            echo "DELETE FROM `$this->tabelName` WHERE `$deletItem` = '$WhereValue'";
            $query = $conn->query("DELETE FROM `$this->tabelName` WHERE `$deletItem` = '$WhereValue' ");
        } else {
            echo 'empty';
        }
    }



    public function Update($updItem, $WhereValue)
    {
        if ($updItem != "" and $WhereValue != "") {
            $up = $this->Connect();

            //"UPDATE `zoo` SET `id`='[value-1]',`animal`='[value-2]'"
            echo "UPDATE FROM `$this->tabelName` WHERE `$updItem` = '$WhereValue'";
            $query = $conn->query("Update FROM `$this->tabelName` WHERE `$Item` = '$WhereValue' ");
        } else {
            echo 'empty';
        }
    }

    public function Select($columns)
    {
        if (!empty($columns)) {


            $strcol = "";
            foreach ($columns as $value) {
                if ($value == '*') {
                    $strcol = '*';
                    break;
                }

                if ($strcol != "") {
                    $strcol .= ",`$value`";
                } else {
                    $strcol .= "`$value`";
                }

            }
            
            $conn = $this->Connect();
            echo "SELECT " . $strcol . "FROM `$this->tabelName`";
            $query = $conn->query("SELECT $strcol FROM `$this->tabelName`");
            $ArrayOut = [];
            while ($row = $query->fetch_assoc()) {
                array_push($ArrayOut, $row);
            }
            return $ArrayOut;
        }
    }


}