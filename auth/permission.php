<?php

require_once __DIR__ . '/../config.php';

function has_permission($userId, $permission): bool
{
    global $PERMISSIONS;
    $roleId = get_role($userId);
    return in_array($permission, $PERMISSIONS[$roleId]);
}

function get_role($userId) {
    global $STAFF;
    foreach ($STAFF as $roleId => $users) {
        if (in_array($userId, $users)) {
            return $roleId;
        }
    }
    return get_role_name(DEFAULT_ROLE);
}

function get_role_name($roleId) {
    global $ROLES;
    return $ROLES[$roleId] ?? null;
}

function get_role_id($roleName) {
    global $ROLES;
    return array_search($roleName, $ROLES);
}

