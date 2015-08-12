<?php
/**
 * User: khaled
 * Date: 8/2/15 at 1:35 PM
 */

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Position
{

    const STATUS_GREEN = 0;
    const STATUS_YELLOW = 1;
    const STATUS_RED = 2;

    protected $statusIcon = [
        'http://maps.google.com/mapfiles/ms/icons/green-dot.png',
        'http://maps.google.com/mapfiles/ms/icons/yellow-dot.png',
        'http://maps.google.com/mapfiles/ms/icons/red-dot.png',
    ];

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;


    /**
     * @ORM\Column(type="string")
     */
    protected $latitude;

    /**
     * @ORM\Column(type="string")
     */
    protected $longitude;

    /**
     * @ORM\Column(type="smallint")
     */
    protected $status;


    /**
     * @ORM\Column(type="string")
     */
    protected $comment;


    /**
     * @ORM\Column(type="string")
     */
    protected $image;

    /**
     * @ORM\Column(type="string")
     */
    protected $icon;

    /**
     * @ORM\Column(type="integer")
     */
    protected $created_date;

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
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param mixed $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param mixed $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
        $this->setIcon($this->statusIcon[$this->status]);
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param mixed $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return mixed
     */
    public function getCreatedDate()
    {
        return $this->created_date;
    }

    /**
     * @param mixed $created_date
     */
    public function setCreatedDate($created_date)
    {
        $this->created_date = $created_date;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getIcon()
    {
        return ['url'=>$this->icon];
    }

    /**
     * @param mixed $icon
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
    }




}