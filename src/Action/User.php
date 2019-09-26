<?php

namespace Dialogflow\Action;

use Carbon\Carbon;
use Dialogflow\Action\User\Name;

class User
{
    /** @var null|Dialogflow\Action\User\Name */
    protected $name;

    /** @var null|Carbon\Carbon * */
    protected $lastSeen;

    /** @var string */
    protected $accessToken;

    /**
     * @param array $data request array
     */
    public function __construct($data)
    {
        if (isset($data['profile'])) {
            $this->name = new Name($data['profile']);
        }

        if (isset($data['lastSeen'])) {
            $this->lastSeen = new Carbon($data['lastSeen']);
        }

        if (isset($data['accessToken'])) {
            $this->accessToken = $data['accessToken'];
        }
    }

    /**
     * User's permissioned name info.
     *
     * @return null|Dialogflow\Action\User\Name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Timestamp for the last access from the user.
     *
     * @return null|Carbon\Carbon
     */
    public function getLastSeen()
    {
        return $this->lastSeen;
    }

    /**
     * string with the user access token
     *
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }
}
