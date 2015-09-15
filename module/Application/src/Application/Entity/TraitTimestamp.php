<?php
/**
 * User: khaled
 * Date: 9/2/15 at 1:50 PM
 */

namespace Application\Entity;


trait TraitTimestamp
{

    /**
     * @ORM\Column(type="integer")
     */
    protected $createdDate;

    /**
     * @param mixed $createdDate
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }


}