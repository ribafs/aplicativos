<?php

require_once 'vendor/autoload.php';

    use MatijaBelec\Acl\Acl;
    $acl = new Acl();

    // create role hierarchy
    $acl->addRole('guest');
    $acl->addRole('user', 'guest');
    $acl->addRole('administrator', 'user');

    // create actions tree
    $acl->allow('guest', 'user.canUpdate');
    $acl->allow('guest', 'user.canDelete');
    $acl->allow('user', 'user.canCreate');
    $acl->deny('user', 'user.canDelete');
    $acl->allow('administrator', ['user.canRead', 'user.canUpdate']);
    $acl->allow('administrator', 'user.canDelete');

    // check actions on user
    $adminIsAllowedToGetUserDetails = $acl->isAllowed('administrator', 'user.canRead');
    $userIsAllowedToCreateNewUser = $acl->isAllowed('user', 'user.canCreate');

print $userIsAllowedToCreateNewUser;// Return 1/true
