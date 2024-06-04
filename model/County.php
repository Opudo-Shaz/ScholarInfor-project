<?php
require_once 'database.php';
require_once 'Role.php';
class County {
    public $id;
    public $name;
    public $roles;

    public function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;
        $this->roles = array();
        $this->initRoles();
    }

    public function initRoles() {
        $db = new Database();

        $sql = "SELECT t1.role_id, t2.role_name FROM county_role AS t1
                JOIN roles AS t2 ON t1.role_id = t2.role_id
                WHERE t1.county_id = :county_id";
        $sth = $db->conn->prepare($sql);
        $sth->execute(array(":county_id" => $this->id));

        while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
            $this->roles[$row["role_id"]] = Role::getRolePerms($row["role_id"]);
        }
    }
}

?>