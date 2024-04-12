<?php

require_once __DIR__ . '/../config.php';

function has_permission($userId, $permission): bool
{
    $roleId = get_role($userId);
    if (isset(PERMISSIONS[$roleId])) {

        // If the role has the permission "ALL" then it has all permissions
        if (in_array("ALL", PERMISSIONS[$roleId])) {
            return true;
        }

        return in_array($permission, PERMISSIONS[$roleId]);
    }
    return false;
}

function get_role($userId) : int
{
    foreach (STAFF as $roleId => $users) {
        if (in_array($userId, $users)) {
            return $roleId;
        }
    }
    return DEFAULT_ROLE;
}

function get_role_name($roleId): ?string{
    return ROLES[$roleId] ?? null;
}

function get_role_id($roleName) {
    return array_search($roleName, ROLES);
}


