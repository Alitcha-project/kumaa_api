<?php

namespace Kumaa\Action;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;
use Kumaa\Framework\Validator\Validator;

class CrudAction
{
    protected $model = null;
    protected $field_allow = [];

    public function action_get(ServerRequest $request): Response
    {
        $response = new Response(200);
        $id = $request->getAttribute('id', null);

        $data = $id !== null ?
        $this->model->get($id)
        :
        $data = $this->model->getAll();

        $body = $response->getBody();
        $body->write(json_encode($data));
        $response = $response->withBody($body);

        return $response;
    }

    public function action_delete(ServerRequest $request): Response
    {
        $response = new Response(200);
        $id = $request->getAttribute('id', null);

        $body = $response->getBody();

        if ($this->check_exist($id)) {
            $test = $this->model->delete($id);
            if ($test == true) {
                $body->write(json_encode(["message"=>"delete success"]));
            } else {
                $body->write(json_encode(["message"=>"delete error"]));
            }
        }

        $response = $response->withBody($body);

        return $response;
    }

    public function action_update(ServerRequest $request): Response
    {
        $response = new Response(200);
        $id = $request->getAttribute('id', null);

        $body = $response->getBody();

        if ($this->check_exist($id)) {
            $test = $this->model->update((int)$id, $this->getParams($request));
            if ($test == true) {
                $body->write(json_encode(["message"=>"update success"]));
            } else {
                $body->write(json_encode(["message"=>"update error"]));
            }
        }

        $response = $response->withBody($body);

        return $response;
    }

    private function check_exist($id): bool
    {

        $data = $id !== null ?
        $this->model->get($id)
        :
        null;

        if ($data === null || $data === []) {
            return false;
        }

        return true;
    }

    protected function getParams(ServerRequest $request)
    {
        return array_filter($request->getParsedBody(), function ($key) {
            return in_array($key, $this->field_allow);
        }, ARRAY_FILTER_USE_KEY);
    }

    protected function getValidator(ServerRequest $request)
    {
        return new Validator($request->getParsedBody());
    }
}
