<?php
    include '../Entity/Roles.php';
    class viewRolesController{
        public function __construct()
        {
            
        }
        function passViewRolesPara($search){
            $role = new Roles();
            $arrayResult = $role ->retrieveRoles($search);
            return $arrayResult;
        }
    }
?>