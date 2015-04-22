<?php

namespace ZeeCoder\MailChimp\Helper;

use Drewm\MailChimp;

class Helper
{
    /**
     * Values:
     * [
     *     'secret_api' => '',
     * ]
     */
    private $config;

    public function __construct($config)
    {
        $this->config = $config;
        $this->client = new MailChimp($this->config['secret_api']);
    }

    public function subscribeToList($listId, $email, $firstName = '', $lastName = '')
    {
        return $this->client
            ->call(
                'lists/subscribe',
                [
                    'id' => $listId,
                    'email' => ['email' => $email],
                    'merge_vars' => [
                        'FNAME' => $firstName,
                        'LNAME' => $lastName,
                    ],
                    'double_optin' => false,
                    'update_existing' => true,
                    'replace_interests' => false,
                    'send_welcome' => true,
                ]
            );
    }
}
