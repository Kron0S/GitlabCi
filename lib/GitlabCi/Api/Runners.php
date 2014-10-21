<?php

namespace GitlabCi\Api;

class Runners extends AbstractApi
{
    public function all()
    {
        return $this->get('runners');
    }
    public function register($token, $public_key)
    {
        return $this->post('runners/register', array(
            'token' => $token ,
            'public_key' => $public_key
        ));
    }
}
