<?php
/**
 * Created by IntelliJ IDEA.
 * User: mcneely
 * Date: 8/6/16
 * Time: 1:27 PM
 */

namespace AppBundle\Service;


use AppBundle\Entity\Project;
use Doctrine\ORM\EntityManager;

/**
 * Class GitHubDB
 * @package AppBundle\Service
 * Class contains routines to update database from Github as well pull entries from database.
 * Http Service, Doctrine Entity Manger and Github URL Parameters are injected as dependencies.
 */
class GitHubDB
{

    protected $http;
    protected $url;
    protected $entityManager;

    public function __construct(Http $http, EntityManager $entityManager, $url)
    {
        $this->http = $http;
        $this->url = $url;
        $this->entityManager = $entityManager;
    }

    /**
     * Pull data from Github and Add/Update entries.
     */
    public function updateDB()
    {
        $response = $this->http->doGetRequestArray($this->url);
        foreach ($response["items"] as $item) {
            $id = $item['id'];
            unset($item['id']);
            $project = $this->entityManager->getRepository('AppBundle:Project')->find($id);
            if(!$project) {
                $project = new Project();
                $project->setId($id);
                $this->entityManager->persist($project);
            }

            $project->hydrate($item);
            $this->entityManager->flush();
        }
    }

    /**
     * Returns an array of Project entities for display.
     * @return \AppBundle\Entity\Project[]|array
     */
    public function getProjects() {
        return $this->entityManager->getRepository('AppBundle:Project')->findBy([], ['stargazersCount' => 'DESC']);
    }

}