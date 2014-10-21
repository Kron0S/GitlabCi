<?php

namespace GitlabCi\Model;

use GitlabCi\Client;
use GitlabCi\Api\AbstractApi as Api;

class Project extends AbstractModel
{
    protected static $_properties = array(
		"id",
		"name",
		"timeout",
		"scripts",
		"token",
		"default_ref",
		"gitlab_url",
		"always_build",
		"polling_interval",
		"public",
		"ssh_url_to_repo",
		"gitlab_id"
    );

    public static function fromArray(Client $client, array $data)
    {
        $project = new static($data['id']);
		$project->setClient($client);

        return $project->hydrate($data);
    }

    public static function create(Client $client, $name, $id, $gitlab_url, $ssh_url_to_repo, array $params = array())
    {
        $data = $client->api('projects')->create($name, $id, $gitlab_url, $ssh_url_to_repo, $params);
        return static::fromArray($client, $data);
    }

    public static function all(Client $client)
    {
        $data = $client->api('projects')->all();
		$projects = array();
		foreach ($data as $projectData) {
			$projects[] = static::fromArray($client, $projectData);
		}
        return $projects;
    }
	
    public static function owned(Client $client)
    {
        $data = $client->api('projects')->owned();
		$projects = array();
		foreach ($data as $projectData) {
			$projects[] = static::fromArray($client, $projectData);
		}
        return $projects;
    }

    public function __construct($id = null)
    {
        $this->id = $id;
    }

    public function show()
    {
        $data = $this->api('projects')->show($this->id);

        return static::fromArray($this->getClient(), $data);
    }
	
    public function update($params)
    {
        $this->api('projects')->update($this->id, $params);

        return true;
    }
    public function remove()
    {
        $this->api('projects')->remove($this->id);

        return true;
    }
    public function linkToRunner($runner_id)
    {
        $data = $this->api('projects')->linkToRunner($this->id, $runner_id);

        return $this;
    }
    public function removeToRunner($runner_id)
    {
        $data = $this->api('projects')->removeFromRunner($this->id, $runner_id);

        return $this;
    }

}
