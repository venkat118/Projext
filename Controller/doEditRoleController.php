<?php
    include '../Entity/Roles.php';
    class editRoleController{
        public function __construct()
        {
            
        }
        function passEditRolePara($roleID, $accountType, $desc){
            $role = new Roles();
            $result = $role -> editRoles($roleID, $accountType, $desc);
        }
    }
?>