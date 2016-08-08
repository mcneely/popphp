<?php
/**
 * Created by IntelliJ IDEA.
 * User: mcneely
 * Date: 8/5/16
 * Time: 11:20 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class that binds doctrine to the database.
 * @ORM\Entity
 * @ORM\Table(name="project")
 * Since we're using magic method getters and setters,
 * the following satisfies the IDE syntax highlighting.
 * @method integer getId()
 * @method setId(integer $id)
 * @method string getDescription()
 * @method setDescription(string $description)
 * @method string getName()
 * @method setName(string $name)
 * @method string getHtmlUrl()
 * @method setHtmlUrl(string $htmlUrl)
 * @method integer getStargazersCount)
 * @method setStargazersCount(integer $stargazersCount)
 */
class Project extends Generic
{
    /**
     * @var string
     */
    protected $dateFormat = 'm/d/Y g:i a';
    /**
     * @ORM\Column(type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @var integer
     */
    protected $id;
    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    protected $name;
    /**
     * @ORM\Column(type="string",length=255)
     * @var string
     */
    protected $htmlUrl;
    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    protected $createdAt;
    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    protected $pushedAt;
    /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $description;
    /**
     * @ORM\Column(type="integer")
     * @var integer
     */
    protected $stargazersCount;

    /**
     * @param string $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = new \DateTime($createdAt);
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->createdAt->format($this->dateFormat);
    }

    /**
     * @param string $pushedAt
     */
    public function setPushedAt($pushedAt)
    {
        $this->pushedAt = new \DateTime($pushedAt);
    }

    /**
     * @return string
     */
    public function getPushedAt()
    {
        return $this->pushedAt->format($this->dateFormat);
    }

}
