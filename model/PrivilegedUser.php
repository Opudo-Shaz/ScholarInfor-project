<?php
require_once 'database2.php';
require_once 'User.class.php';
require_once 'Role.php';

class PrivilegedUser extends User
{
    private $roles;

    public function __construct()
    {
        parent::__construct();
    }

    // override User method
    public static function getByEmail($email)
    {
        $db = new Database();

        $sql = "SELECT id, first_name, last_name, email, created, modified FROM users WHERE email = :email";
        $sth = $db->conn->prepare($sql);
        $sth->execute(array(":email" => $email));
        $result = $sth->fetchAll();

        if (!empty($result)) {
            $privUser = new PrivilegedUser();
            $privUser->user_id = $result[0]["id"];
            $privUser->first_name = $result[0]["first_name"];
            $privUser->last_name = $result[0]["last_name"];
            $privUser->email = $email; // Assuming $email is defined earlier
            $privUser->modified_on = $result[0]["modified"];
            $privUser->created_on = $result[0]["created"];
            $privUser->initRoles();
            return $privUser;
        } else {
            // Handle the case where $result is empty
            return null; // or false, or throw an exception, depending on your needs
        }
    }


    // populate roles with their associated permissions
    protected function initRoles()
    {
        $db = new Database();

        $this->roles = array();
        $sql = "SELECT t1.role_id, t2.role_name FROM user_role AS t1
                JOIN roles AS t2 ON t1.role_id = t2.role_id
                WHERE t1.user_id = :user_id";
        $sth = $db->conn->prepare($sql);
        $sth->execute(array(":user_id" => $this->user_id));

        while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
            $this->roles[$row["role_name"]] = Role::getRolePerms($row["role_id"]);
        }
    }

    // check if user has a specific privilege
    public function hasPrivilege($perm)
    {
        foreach ($this->roles as $role) {
            foreach ($role as $key => $value) {
                if (isset($value[$perm])) {
                    return true;
                }
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
    public static function insertPerm($role_id, $perm_id)
    {
        $db = new Database();

        $sql = "INSERT INTO role_perm (role_id, perm_id) VALUES (:role_id, :perm_id)";
        $sth = $db->conn->prepare($sql);
        return $sth->execute(array(":role_id" => $role_id, ":perm_id" => $perm_id));
    }

    // delete ALL role permissions
    public static function deletePerms()
    {
        $db = new Database();

        $sql = "TRUNCATE role_perm";
        $sth = $db->conn->prepare($sql);
        return $sth->execute();
    }
}