<?php

namespace VinaoCruz\Rbac;

class Permission
{
	private $db;

	public function __construct(\PDO $db)
	{
		$this->db = $db;
	}

	public function create($resource, Role $role)
	{
		$sql = "INSERT INTO role_permission (role, permission) VALUES (:role, :permission)";
	    $sth = $this->db->prepare($sql);

	    $sth->bindParam(":role", $role_id, \PDO::PARAM_STR);
	    $sth->bindParam(":permission", $user_id, \PDO::PARAM_STR);

        return $sth->execute([":role" => $role->getName(), ":permission" => $resource]);
	}

	public function get(Role &$role) : Role
	{
		$sql = "SELECT permission FROM role_permission WHERE role = :role";
        $sth = $this->db->prepare($sql);

        $sth->execute([":role" => $role->getName()]);

        $role->setPermissions($sth->fetchAll(\PDO::FETCH_COLUMN, 0));
        return $role;
	}
}
