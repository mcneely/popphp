<?php
/**
 * Created by IntelliJ IDEA.
 * User: mcneely
 * Date: 8/5/16
 * Time: 11:20 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Util\Inflector;

/**
 * @ORM\Entity
 * @ORM\Table(name="project")
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
class Project
{

    private $dateFormat = 'm/d/Y g:i a';
    /**
     * @ORM\Column(type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;
    /**
     * @ORM\Column(type="string",length=255)
     */
    private $htmlUrl;
    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $createdAt;
    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $pushedAt;
    /**
     * @ORM\Column(type="text")
     */
    private $description;
    /**
     * @ORM\Column(type="integer")
     */
    private $stargazersCount;

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

    /**
     * "Magic" Method the sets up generic "get" getters and "set" setters.
     *
     * @param $method
     * @param $arguments
     * @return mixed
     */
    public function __call($method, $arguments)
    {
        $action = substr($method, 0, 3);
        $name = Inflector::camelize(substr($method, 3));
        $method = $action . ucfirst($name);

        if(in_array($action, ['get', 'set'])) {
            if (method_exists($this, $method)) {
                return ($arguments && 'get' !== $action) ? call_user_func_array([$this, $method], $arguments) : $this->{$method}();
            }

            if (property_exists($this, $name)) {
                if ('set' == $action) {
                    $this->$name = $arguments[0];
                }

                return ('get' == $action) ? $this->$name : $this;
            }
        }

        return null;
    }

    /**
     * Populates Class with array data.
     * @param array $data
     */
    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $function = "set$key";
            $this->{$function}($value);
        }
    }
}
