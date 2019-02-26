<?php
class ModelControlAcceso
{
    // Elementos privados


    public function isValidUser($u, $p) {
        return $u == 'jorge' && $p == '1234';
    }

    public function isValidToken() {
        // TODO
        return false;
    }
}
?>
