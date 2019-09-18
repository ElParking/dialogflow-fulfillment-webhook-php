<?php

namespace Dialogflow\Action\Questions;

use Dialogflow\Action\Interfaces\QuestionInterface;

class SignIn implements QuestionInterface
{
    /**
     * Why the app needs to ask the user to sign in.
     * For example: "To check your account balance".
     *
     * @var string
     */
    protected $permissionContext;

    /**
     * SignIn constructor.
     * @param string $permissionContext the context for seeking permissions
     */
    public function __construct($permissionContext = null)
    {
        $this->permissionContext = $permissionContext;
    }

    /**
     * Render a single Rich Response item as array.
     *
     * @return array|null
     */
    public function renderRichResponseItem()
    {
    }

    /**
     * Render System Intent as array.
     *
     * @return array|null
     */
    public function renderSystemIntent()
    {
        $out = [
            'intent' => 'actions.intent.SIGN_IN',
            'data'   => [
                '@type' => 'type.googleapis.com/google.actions.v2.SignInValueSpec',
            ],
        ];

        if (is_string($this->permissionContext)) {
            $out['data']['optContext'] = $this->permissionContext;
        }

        return $out;
    }
}
