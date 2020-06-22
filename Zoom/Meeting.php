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
        $response = $this->client->doRequest(
            'GET',
            '/users/{userId}',
            [],
            ['userId' => Config::$email]
        );

        if ($this->client->responseCode() == 200) {
            return $response['id'];
        } else {
            print_r($response);
            exit();
        }
    }

    public function create($meetingDetails)
    {
        $response = $this->client->doRequest(
            'POST',
            '/users/{userId}/meetings',
            [],
            ['userId' => $this->getUserId()],
            json_encode($meetingDetails)
        );

        if ($this->client->responseCode() == 201) {
            return $response;
        } else {
            return false;
        }
    }

    public function update($meetingDetails, $meetingId)
    {
        $response = $this->client->doRequest(
            'PATCH',
            '/meetings/{meetingId}',
            [],
            ['meetingId' => $meetingId],
            json_encode($meetingDetails)
        );

        if ($this->client->responseCode() == 201) {
            return $response;
        } else {
            return false;
        }
    }

    public function delete($meetingId)
    {
        $response = $this->client->doRequest(
            'DELETE',
            '/meetings/{meetingId}',
            [],
            ['meetingId' => $meetingId],
            json_encode($meetingDetails)
        );

        if ($this->client->responseCode() == 201) {
            return $response;
        } else {
            return false;
        }
    }
}