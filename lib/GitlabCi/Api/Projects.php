<?php

namespace GitlabCi\Api;

class Projects extends AbstractApi
{
    public function all()
    {
        return $this->get('projects');
    }
    public function owned()
    {
        return $this->get('projects/owned');
    }

    public function show($project_id)
    {
        return $this->get('projects/'.urlencode($project_id), array(
			'id' => $project_id
		));
    }

    public function create($name, $project_id, $gitlab_url, $ssh_url_to_repo, array $params = array())
    {
        $params['name'] = $name;
        $params['gitlab_id'] = $project_id;
        $params['gitlab_url'] = $gitlab_url;
        $params['ssh_url_to_repo'] = $ssh_url_to_repo;

        return $this->put('projects/create', $params);
    }

    public function update($project_id, array $params = array())
    {
        $params['gitlab_id'] = $project_id;

        return $this->put('projects/'.urlencode($project_id), $params);
    }

    public function remove($project_id)
    {
        return $this->delete('projects/'.urlencode($project_id), array(
			'id' => $project_id
		));
    }

    public function linkToRunner($project_id, $runner_id)
    {
        return $this->post('projects/'.urlencode($project_id).'/runners/'.urlencode($runner_id));
    }

    public function removeFromRunner($project_id, $runner_id)
    {
        return $this->delete('projects/'.urlencode($project_id).'/runners/'.urlencode($runner_id));
    }
}
