<?php
namespace Zoom;

use Zoom\Client;
use Zoom\Config;

class Meeting
{
    private $client;
    public $zoomError;
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
            $this->zoomError = $response;
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

        if ($this->client->responseCode() == 204) {
            return $response;
        } else {
            $this->zoomError = $response;

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
            []
        );

        if ($this->client->responseCode() == 204) {
            return $response;
        } else {
            $this->zoomError = $response;

            return false;
        }
    }

    public function end($meetingId)
    {
        $response = $this->client->doRequest(
            'PUT',
            '/meetings/{meetingId}/status',
            [],
            ['meetingId' => $meetingId],
            json_encode(['action' => 'end'])
        );

        if ($this->client->responseCode() == 204) {
            return $response;
        } else {
            $this->zoomError = $response;

            return false;
        }
    }

    public function list()
    {
        $response = $this->client->doRequest(
            'GET',
            '/users/{userId}/meetings',
            [],
            ['userId' => $this->getUserId()],
            json_encode(['action' => 'end'])
        );

        if ($this->client->responseCode() == 204) {
            return $response;
        } else {
            $this->zoomError = $response;

            return false;
        }
    }

    public function listRegistrants($meetingId)
    {
        $response = $this->client->doRequest(
            'GET',
            '/meetings/{meetingId}/registrants',
            [],
            ['meetingId' => $meetingId],
            json_encode(['action' => 'end'])
        );

        if ($this->client->responseCode() == 200) {
            return $response;
        } else {
            $this->zoomError = $response;

            return false;
        }
    }
    /** Add Registrant to meeting that require registration
     * @param $meetingId meeting id
     * @param Array $registrant {email:"required",first_name:"required"}
     * @return Array of response
     */
    public function addRegistrant($meetingId, $registrant)
    {
        $response = $this->client->doRequest(
            'POST',
            '/meetings/{meetingId}/registrants',
            [],
            ['meetingId' => $meetingId],
            json_encode($registrant)
        );

        if ($this->client->responseCode() == 201) {
            return $response;
        } else {
            $this->zoomError = $response;

            return false;
        }
    }
}