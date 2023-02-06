<?php
//profiles Class

class Profile extends SM {


    public function getInfo ($item)
    {
        $stmt = $this->runQuery( "SELECT $item FROM emg_meta" );
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        while($rows = $stmt->fetch()):
            echo $rows[$item];
            endwhile;
    }
}


