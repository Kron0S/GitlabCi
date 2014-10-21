<?php

namespace GitlabCi\Api;

class Builds extends AbstractApi
{
    public function register($token)
    {
        return $this->post('builds/register', array(
			'token' => $token
		));
    }

    public function update($id, array $params = array())
    {
        $params['id'] = $id;

        return $this->put('builds/'.urlencode($id), $params);
    }
}
