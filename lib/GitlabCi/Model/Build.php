<?php

namespace GitlabCi\Model;

use GitlabCi\Client;
use GitlabCi\Api\AbstractApi as Api;

class Build extends AbstractModel
{
    protected static $_properties = array(
		"id",
		"commands",
		"path",
		"ref",
		"sha",
		"build_id",
		"repo_url",
		"before_sha"
    );

    public static function fromArray(Client $client, array $data)
    {
        $build = new static($data['id']);
		$build->setClient($client);

        return $build->hydrate($data);
    }

    public static function register(Client $client, $token)
    {
        $data = $client->api('builds')->register($token);
        return static::fromArray($client, $data);
    }

    public function __construct($id = null)
    {
        $this->id = $id;
    }
	
    public function update($params)
    {
        $this->api('builds')->update($this->id, $params);

        return true;
    }

}
