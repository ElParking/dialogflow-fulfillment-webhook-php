<?php

namespace Dialogflow\tests\Action;

use Dialogflow\Action\Questions\SignIn;
use Dialogflow\WebhookClient;
use PHPUnit\Framework\TestCase;

class SignInTest extends TestCase
{
    private function getConversation()
    {
        $data = json_decode(file_get_contents(__DIR__.'/../../stubs/request-v2-google.json'), true);

        $agent = new WebhookClient($data);

        return $agent->getActionConversation();
    }

    private function getConversationResponse()
    {
        $data = json_decode(file_get_contents(__DIR__.'/../../stubs/request-v2-google-signin.json'), true);

        $agent = new WebhookClient($data);

        return $agent->getActionConversation();
    }

    public function testCreate()
    {
        $conv = $this->getConversation();

        $conv->ask(new SignIn());

        $this->assertEquals([
            'expectUserResponse' => true,
            'systemIntent'       => [
                'intent' => 'actions.intent.SIGN_IN',
                'data'   => [
                    '@type' => 'type.googleapis.com/google.actions.v2.SignInValueSpec',
                ],
            ],
        ], $conv->render());
    }

    public function testCreateContext()
    {
        $conv = $this->getConversation();

        $conv->ask(new SignIn('To track scores'));

        $this->assertEquals([
            'expectUserResponse' => true,
            'systemIntent'       => [
                'intent' => 'actions.intent.SIGN_IN',
                'data'   => [
                    '@type'      => 'type.googleapis.com/google.actions.v2.SignInValueSpec',
                    'optContext' => 'To track scores'
                ],
            ],
        ], $conv->render());
    }

    public function testResponse()
    {
        $conv = $this->getConversationResponse();

        $status = $conv->getArguments()->get('SIGN_IN');

        $this->assertInternalType('string', $status);

        $this->assertEquals('OK', $status);
    }
}
