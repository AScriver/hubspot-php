<?php

namespace SevenShores\Hubspot\Tests\Unit\Endpoints;

use PHPUnit\Framework\TestCase;
use SevenShores\Hubspot\Endpoints\EmailSubscription;
use SevenShores\Hubspot\Http\Client;

class EmailSubscriptionTest extends TestCase
{
    public function test_subscription_definitions_uses_v3_definitions_endpoint()
    {
        $client = new RecordingClient();
        $endpoint = new EmailSubscription($client);

        $result = $endpoint->subscriptionDefinitions();

        $this->assertSame('ok', $result);
        $this->assertSame([
            [
                'method' => 'get',
                'endpoint' => 'https://api.hubapi.com/communication-preferences/v3/definitions',
                'options' => [],
                'queryString' => null,
                'requiresAuth' => true,
            ],
        ], $client->calls);
    }

    public function test_subscription_statuses_uses_v3_status_endpoint()
    {
        $client = new RecordingClient();
        $endpoint = new EmailSubscription($client);

        $result = $endpoint->subscriptionStatuses('test+tag@example.com');

        $this->assertSame('ok', $result);
        $this->assertSame([
            [
                'method' => 'get',
                'endpoint' => 'https://api.hubapi.com/communication-preferences/v3/status/email/test%2Btag%40example.com',
                'options' => [],
                'queryString' => null,
                'requiresAuth' => true,
            ],
        ], $client->calls);
    }

    public function test_subscribe_posts_to_v3_subscribe_endpoint()
    {
        $client = new RecordingClient();
        $endpoint = new EmailSubscription($client);
        $data = [
            'emailAddress' => 'test@example.com',
            'subscriptionId' => '123',
            'legalBasis' => 'CONSENT_WITH_NOTICE',
        ];

        $result = $endpoint->subscribe($data);

        $this->assertSame('ok', $result);
        $this->assertSame([
            [
                'method' => 'post',
                'endpoint' => 'https://api.hubapi.com/communication-preferences/v3/subscribe',
                'options' => ['json' => $data],
                'queryString' => null,
                'requiresAuth' => true,
            ],
        ], $client->calls);
    }

    public function test_unsubscribe_posts_to_v3_unsubscribe_endpoint()
    {
        $client = new RecordingClient();
        $endpoint = new EmailSubscription($client);
        $data = [
            'emailAddress' => 'test@example.com',
            'subscriptionId' => '123',
            'legalBasis' => 'CONSENT_WITH_NOTICE',
        ];

        $result = $endpoint->unsubscribe($data);

        $this->assertSame('ok', $result);
        $this->assertSame([
            [
                'method' => 'post',
                'endpoint' => 'https://api.hubapi.com/communication-preferences/v3/unsubscribe',
                'options' => ['json' => $data],
                'queryString' => null,
                'requiresAuth' => true,
            ],
        ], $client->calls);
    }
}

class RecordingClient extends Client
{
    public $calls = [];

    public function request(string $method, string $endpoint, array $options = [], $query_string = null, bool $requires_auth = true)
    {
        $this->calls[] = [
            'method' => $method,
            'endpoint' => $endpoint,
            'options' => $options,
            'queryString' => $query_string,
            'requiresAuth' => $requires_auth,
        ];

        return 'ok';
    }
}
