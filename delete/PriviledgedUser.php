<?php
require_once "User.class.php";
require_once "Permission.php";

class PrivilegedUser extends User
{
    private $roles;

    public function __construct()
    {
        parent::__construct();
    }

    // override User method
    public static function getByEmail($email, $mysqli)
    {
        $sql = "SELECT * FROM users WHERE email = ?";
        $sth = $mysqli->prepare($sql);
        $sth->bind_param("s", $email);
        if (!$sth->execute()) {
            throw new Exception("Execute failed: " . $sth->error);
        }
        $result = $sth->get_result()->fetch_assoc();

        if (!empty($result)) {
            $privUser = new PrivilegedUser();
            $privUser->id = $result["id"];
            $privUser->email = $email;
            $privUser->password = $result["password"];
            $privUser->initRoles($mysqli);
            return $privUser;
        } else {
            return false;
        }
    }

    // populate roles with their associated permissions
    protected function initRoles($mysqli)
    {
        $this->roles = array();
        $sql = "SELECT t1.role_id, t2.role_name FROM user_role as t1
                JOIN roles as t2 ON t1.role_id = t2.role_id
                WHERE t1.user_id = ?";
        $sth = $mysqli->prepare($sql);
        $sth->bind_param("i", $this->user_id);
        if (!$sth->execute()) {
            throw new Exception("Execute failed: " . $sth->error);
        }
        $result = $sth->get_result();

        while ($row = $result->fetch_assoc()) {
            $this->roles[$row["role_name"]] = Role::getRolePerms($row["role_id"], $mysqli);
        }
    }

    // check if user has a specific privilege
    public function hasPrivilege($perm)
    {
        foreach ($this->roles as $role) {
            if ($role->hasPerm($perm)) {
                return true;
            }
        }
        return false;
    }

    // check if a user has a specific role
    public function hasRole($role_name)
    {
        return isset($this->roles[$role_name]);
    }

    // insert a new role permission association
    public static function insertPerm($role_id, $perm_id, $mysqli)
    {
        $sql = "INSERT INTO role_perm (role_id, perm_id) VALUES (?, ?)";
        $sth = $mysqli->prepare($sql);
        $sth->bind_param("ii", $role_id, $perm_id);
        if (!$sth->execute()) {
            throw new Exception("Execute failed: " . $sth->error);
        }
        return true;
    }

    // delete ALL role permissions
    public static function deletePerms($mysqli)
    {
        $sql = "TRUNCATE role_perm";
        $sth = $mysqli->prepare($sql);
        if (!$sth->execute()) {
            throw new Exception("Execute failed: " . $sth->error);
        }
        return true;
    }
}