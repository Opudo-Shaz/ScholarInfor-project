<?php
require_once "database.php";
const ROLE_SUPERADMIN = 'Superadmin';

class CountyRole {
    public static function assignRoleToCounty($role_id, $county_id) {
        $db = new Database();

        $sql = "INSERT INTO county_roles (role_id, county_id) VALUES (:role_id, :county_id)";
        $sth = $db->conn->prepare($sql);
        return $sth->execute(array(
            ":role_id" => $role_id,
            ":county_id" => $county_id
        ));
    }
}

?>