<?php
/**
 * Created by IntelliJ IDEA.
 * User: mcneely
 * Date: 8/7/16
 * Time: 9:52 PM
 */

namespace AppBundle\Entity;

use Doctrine\Common\Util\Inflector;

/**
 * Class Generic
 * @package AppBundle\Entity
 * Class contains reusable getter/setter method as well a generic hydration method.
 */
class Generic
{
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

        if (in_array($action, ['get', 'set'])) {
            if (method_exists($this, $method)) {
                return ($arguments && 'get' !== $action) ? call_user_func_array([$this, $method],
                    $arguments) : $this->{$method}();
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