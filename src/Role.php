<?php

namespace VinaoCruz\Rbac;

use \Rbac\Role\Role as ZfrRole;

class Role extends ZfrRole
{
	public function setPermissions(array $permissions)
	{
		foreach ($permissions as $permission) {
			$this->addPermission($permission);
		}
	}
}
