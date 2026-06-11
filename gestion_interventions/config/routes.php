<?php
declare(strict_types=1);
use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;
return static function (RouteBuilder $routes): void {
    $routes->setRouteClass(DashedRoute::class);
    $routes->scope("/", function (RouteBuilder $builder): void {
        $builder->connect("/", ["controller"=>"Pages","action"=>"home"]);
        $builder->connect("/login", ["controller"=>"Users","action"=>"login"]);
        $builder->connect("/dashboard", ["controller"=>"Pages","action"=>"dashboard"]);
        $builder->connect("/apropos", ["controller"=>"Pages","action"=>"apropos"]);
        $builder->connect("/parametres", ["controller"=>"Pages","action"=>"parametres"]);
        $builder->connect("/aide", ["controller"=>"Pages","action"=>"aide"]);
        $builder->connect("/test-login", ["controller"=>"Users","action"=>"testlogin"]);
        $builder->connect("/users/login", ["controller"=>"Users","action"=>"login"]);
        $builder->connect("/users/logout", ["controller"=>"Users","action"=>"logout"]);
        $builder->connect("/users/register", ["controller"=>"Users","action"=>"register"]);
        $builder->connect("/users/forgot", ["controller"=>"Users","action"=>"forgot"]);
        $builder->connect("/users/profile", ["controller"=>"Users","action"=>"profile"]);
        $builder->connect("/users/change-password", ["controller"=>"Users","action"=>"changePassword"]);
        $builder->connect("/users/upload-avatar", ["controller"=>"Users","action"=>"uploadAvatar"]);
        $builder->connect("/users/add", ["controller"=>"Users","action"=>"add"]);
        $builder->connect("/interventions", ["controller"=>"Interventions","action"=>"index"]);
        $builder->connect("/interventions/add", ["controller"=>"Interventions","action"=>"add"]);
        $builder->connect("/interventions/view/*", ["controller"=>"Interventions","action"=>"view"]);
        $builder->connect("/interventions/edit/*", ["controller"=>"Interventions","action"=>"edit"]);
        $builder->connect("/interventions/delete/*", ["controller"=>"Interventions","action"=>"delete"]);
        $builder->connect("/livrables", ["controller"=>"Livrables","action"=>"index"]);
        $builder->connect("/livrables/add", ["controller"=>"Livrables","action"=>"add"]);
        $builder->connect("/livrables/edit/*", ["controller"=>"Livrables","action"=>"edit"]);
        $builder->connect("/livrables/delete/*", ["controller"=>"Livrables","action"=>"delete"]);
        $builder->connect("/statistiques", ["controller"=>"Statistiques","action"=>"index"]);
        $builder->connect("/beneficiaires", ["controller"=>"Pages","action"=>"beneficiaires"]);
        $builder->connect("/materiel", ["controller"=>"Pages","action"=>"materiel"]);
        $builder->connect("/rapports", ["controller"=>"Pages","action"=>"rapports"]);
        $builder->fallbacks(DashedRoute::class);
    });
};