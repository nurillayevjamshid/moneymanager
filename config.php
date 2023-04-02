<?php 

class db {

    static function connection() {

    $mysqli = mysqli_connect('localhost', 'root', '', 'moneymanager');
    return $mysqli; 
    }

    static function array_single($sql) {
        $query = mysqli_query(db::connection(), $sql);
        $array = mysqli_fetch_assoc($query);
    return $array;
}

 static function array_all($sql) {
        $query = mysqli_query(db::connection(), $sql);
        $array = mysqli_fetch_all($query, MYSQLI_ASSOC);
    return $array;
}

    static function query($sql) {
        $query = mysqli_query(db::connection(), $sql);
        return $query;
    }

}


?>

