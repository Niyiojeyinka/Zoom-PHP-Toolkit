<?php
namespace Zoom;
use Zoom\Client;
use Zoom\Config;
class Meeting
{
    private $client;
    public function __construct()
    {
        $this->client = new Client();
    }

    public function getUserId()
    {
        $response = $client->doRequest(
            'GET',
            '/users/{userId}',
            [],
            ['userId' => Config::$email]
        );

        if ($client->responseCode() == 200) {
            return $response['id'];
        } else {
            print_r($response);
            exit();
        }
    }

    public function create($meetingDetails)
    {
        $response = $client->doRequest(
            'POST',
            '/users/{userId}/meetings',
            [],
            ['userId' => $this->getUserId()],
            json_encode($meetingDetails)
        );

        if ($client->responseCode() == 201) {
            return $response;
        } else {
            return false;
        }
    }
}