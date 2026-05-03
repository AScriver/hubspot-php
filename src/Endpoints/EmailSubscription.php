<?php

namespace SevenShores\Hubspot\Endpoints;

/**
 * @see https://developers.hubspot.com/docs/api-reference/legacy/communication-preferences/v3/guide
 */
class EmailSubscription extends Endpoint
{
    /**
     * Get all subscription definitions for the portal.
     *
     * @see https://developers.hubspot.com/docs/api-reference/legacy/communication-preferences/v3/get-subscription-definitions
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function subscriptionDefinitions()
    {
        $endpoint = 'https://api.hubapi.com/communication-preferences/v3/definitions';

        return $this->client->request('get', $endpoint);
    }

    /**
     * Get subscription statuses for a contact email address.
     *
     * @see https://developers.hubspot.com/docs/api-reference/legacy/communication-preferences/v3/get-subscription-statuses-for-a-contact
     *
     * @param string $emailAddress
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function subscriptionStatuses($emailAddress)
    {
        $emailAddress = url_encode($emailAddress);
        $endpoint = "https://api.hubapi.com/communication-preferences/v3/status/email/{$emailAddress}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Subscribe a contact to a given subscription type.
     *
     * @see https://developers.hubspot.com/docs/api-reference/legacy/communication-preferences/v3/subscribe-contact
     *
     * @param array $data
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function subscribe(array $data = [])
    {
        $endpoint = 'https://api.hubapi.com/communication-preferences/v3/subscribe';

        return $this->client->request('post', $endpoint, ['json' => $data]);
    }

    /**
     * Unsubscribe a contact from a given subscription type.
     *
     * @see https://developers.hubspot.com/docs/api-reference/legacy/communication-preferences/v3/unsubscribe-contact
     *
     * @param array $data
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function unsubscribe(array $data = [])
    {
        $endpoint = 'https://api.hubapi.com/communication-preferences/v3/unsubscribe';

        return $this->client->request('post', $endpoint, ['json' => $data]);
    }

    /**
     * Get email subscription types for a portal.
     *
     * @see https://developers.hubspot.com/docs/methods/email/get_subscriptions
     *
     * @param int $portalId
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function subscriptions($portalId = null)
    {
        $endpoint = 'https://api.hubapi.com/email/public/v1/subscriptions';

        return $this->client->request(
            'get',
            $endpoint,
            [],
            $this->getQueryString($portalId)
        );
    }

    /**
     * View subscriptions timeline for a portal.
     *
     * @see https://developers.hubspot.com/docs/methods/email/get_subscriptions_timeline
     *
     * @param array $params Optional parameters
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function subscriptionsTimeline(array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/email/public/v1/subscriptions/timeline';

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string($params)
        );
    }

    /**
     * Get email subscription status for an email address.
     *
     * @see https://developers.hubspot.com/docs/methods/email/get_status
     *
     * @param string $email
     * @param int    $portalId
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function subscriptionStatus($email, $portalId = null)
    {
        $endpoint = "https://api.hubapi.com/email/public/v1/subscriptions/{$email}";

        return $this->client->request(
            'get',
            $endpoint,
            [],
            $this->getQueryString($portalId)
        );
    }

    /**
     * Update email subscription status for an email address.
     *
     * @see https://developers.hubspot.com/docs/methods/email/update_status
     *
     * @param string $email
     * @param int    $portalId
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function updateSubscription($email, array $data = [], $portalId = null)
    {
        $endpoint = "https://api.hubapi.com/email/public/v1/subscriptions/{$email}";

        return $this->client->request(
            'put',
            $endpoint,
            ['json' => $data],
            $this->getQueryString($portalId)
        );
    }

    /**
     * @param int $portalId
     *
     * @return string
     */
    protected function getQueryString($portalId)
    {
        if (!empty($portalId)) {
            return build_query_string(['portalId' => $portalId]);
        }

        return null;
    }
}
