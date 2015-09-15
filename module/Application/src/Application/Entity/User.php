<?php
/**
 * Created by PhpStorm.
 * User: khaled
 * Date: 03/04/15
 * Time: 19:13
 */

namespace Application\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class User
 * @ORM\Entity
 */
class User {


    const GENDER_MALE = "m";
    const GENDER_FEMALE = "f";

    const ROLE_USER = 'u';

    const VALUE_TRUE = 1;
    const VALUE_FALSE = 0;

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $lastname;

    /**
     * @ORM\Column(type="string")
     */
    protected $firstname;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=14)
     */
    protected $phone;

    /**
     * @ORM\Column(type="string", options={"default" = "u"})
     */
    protected $role;

    /**
     * @ORM\Column(type="string")
     */
    protected $password;

    /**
     * @ORM\Column(type="integer", options={"default"=0})
     */
    protected $emailVerified;

    /**
     * @ORM\Column(type="integer", options={"default"=0})
     */
    protected $blocked;

    /**
     * @ORM\Column(type="integer")
     */
    protected $registredDate;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $lastLogin;



    /*METHODS*/
    public function __construct(){
        $this->bookings = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role=null)
    {
        if(!$role)
            $this->role = self::ROLE_USER;
        else
            $this->role = $role;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = sha1($password);
    }


    /**
     * @return mixed
     */
    public function isBanned()
    {
        return $this->banned;
    }

    /**
     * @param mixed $banned
     */
    public function setBanned($banned)
    {
        if($banned)
            $this->banned = self::VALUE_TRUE;
        else
            $this->banned = self::VALUE_FALSE;
    }

    /**
     * @return mixed
     */
    public function isEmailVerified()
    {
        return $this->emailVerified;
    }

    /**
     * @param mixed $emailVerified
     */
    public function setEmailVerified($emailVerified)
    {
        if($emailVerified){
            $this->emailVerified = self::VALUE_TRUE;
        }else{
            $this->emailVerified = self::VALUE_FALSE;
        }
    }

    /**
     * @return mixed
     */
    public function isPhoneVerified()
    {
        return $this->phoneVerified;

    }

    /**
     * @param mixed $phoneVerified
     */
    public function setPhoneVerified($phoneVerified)
    {
        if($phoneVerified){
            $this->phoneVerified = self::VALUE_TRUE;
        }else{
            $this->phoneVerified = self::VALUE_FALSE;
        }
    }

    /**
     * @return mixed
     */
    public function isBlocked()
    {
        return $this->blocked;
    }

    /**
     * @param mixed $blocked
     */
    public function setBlocked($blocked)
    {
        if($blocked)
            $this->blocked = self::VALUE_TRUE;
        else{
            $this->blocked = self::VALUE_FALSE;
        }
        return $this;
    }






    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        //todo verifie if valid phone number using regx
        $this->phone = $phone;
    }





    /**
     * @return mixed
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }

    /**
     * @param mixed $lastlogin
     */
    public function setLastLogin($lastlogin)
    {
        $this->lastLogin = $lastlogin;
    }

    /**
     * @return mixed
     */
    public function getRegistredDate()
    {
        return $this->registredDate;
    }

    /**
     * @param mixed $registredDate
     */
    public function setRegistredDate($registredDate)
    {
        $this->registredDate = $registredDate;
    }


}