<?php
use PHPUnit\Framework\TestCase;

class Testfor extends TestCase

{
    

    public function addUserinfo( $email, $password ) {
        $this->userArray[ $email ][ "email" ]  = $email;
        $this->userArray[ $email ][ "password" ]  = $password;
    }

    public function addUserData ( $email, $fullName, $address1, $address2, $city, $state, $zipcode ) {
        $this->userArray[ $email ][ "fullName" ]  = $fullName;
        $this->userArray[ $email ][ "address1" ]  = $address1;
        $this->userArray[ $email ][ "address2" ]  = $address2;
        $this->userArray[ $email ][ "city" ]  = $city;
        $this->userArray[ $email ][ "state" ]  = $state;
        $this->userArray[ $email ][ "zipcode" ]  = $zipcode;
    }

    public function getUser( $email ) {
        return $this->userArray[$email];
    }
}

?>