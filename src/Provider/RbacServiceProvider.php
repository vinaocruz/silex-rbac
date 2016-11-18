<?php

namespace VinaoCruz\Rbac\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Rbac\Rbac;
use VinaoCruz\Rbac\Permission;
use VinaoCruz\Rbac\Role;

class RbacServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
    	$app['rbac'] = function(){
			return new Rbac();
    	};

        $app['permission'] = function() use ($app) {
            if (is_null($app['rbac.db'])) {
                throw new \Exception("PDO not found", 404);
            }
            
            return new Permission($app['rbac.db']);
        };

    	$app['role'] = $app->protect(function($name){
			return new Role($name);
    	});
    }
}
