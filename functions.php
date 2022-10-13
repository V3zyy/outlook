<?php
    function createUuid() {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
    
            // 16 bits for "time_mid"
            mt_rand( 0, 0xffff ),
    
            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand( 0, 0x0fff ) | 0x4000,
    
            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand( 0, 0x3fff ) | 0x8000,
    
            // 48 bits for "node"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
    }

    function getEventOptions() {
        $sql = "SELECT * FROM events WHERE status = ?";
        $data = array('1');
        $results = Database::getData($sql, $data);
        return $results;
    }

    function createSelect($options, $name) {
        $s = "<select name='$name'>";
            foreach($options as $key => $rows) {
                $value = $rows['id'];
                $name = $rows['name'];

                $s .= "<option value='$value'>$name</option>";
            }

        $s .= "</select>";

        return $s;
    }

    function getEvent($id) {
        $sql = "SELECT name FROM events WHERE id= ? AND status = ?";
        $data = array($id, '1');
        $results = Database::getData($sql, $data);
        return $results[0]['name'];
    }

    function switchDate($date) {

        
    }