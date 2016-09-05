<?php

namespace Entity;

/** @Entity @Table(name="User")*/
class User {
  	/** @Column(name="id", type="integer") @id @GeneratedValue */
    private $id;
    /** @Column(name="email", length=200) */
    private $email;
    /** @Column(name="password", length=50) */
    private $password;
    /** @Column(name="description", type="text") */
    private $description;
    /** @Column(name="firstname", length=100) */
    private $firstname;
    /** @Column(name="lastname", length=100) */
    private $lastname;
    /** @Column(name="birthDate", type="date") */
    private $birthDate;

    public function getId() {
        return $this->id;
    }

    public function setId($unid) {
        $this->id = $unid;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($unemail) {
        $this->email = $unemail;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($unpassword) {
        $this->password = $unpassword;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($unedescription) {
        $this->description = $unedescription;
    }

    public function getFirstname() {
        return $this->firstname;
    }

    public function setFirstname($unfirstname) {
        $this->firstname = $unfirstname;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function setLastname($unlastname) {
        $this->lastname = $unlastname;
    }

    public function getBirthDate() {
        return $this->birthDate;
    }

    public function setBirthDate($unebirthDate) {
        $this->birthDate = $unebirthDate;
    }

}
