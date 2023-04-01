<?php

namespace CrmCareCloud\Webservice\RestApi\Client\SDK;

use CrmCareCloud\Webservice\RestApi\Client\Api\UsersApi;
use CrmCareCloud\Webservice\RestApi\Client\Model\ActionsLoginBody1;
use CrmCareCloud\Webservice\RestApi\Client\SDK\Data\AuthTypes;
use GuzzleHttp\Client;
use Psr\Http\Message\RequestInterface;

class AuthenticationHandler
{
    private ?string $token;

    private CareCloud $care_cloud;

    public function __construct(CareCloud $care_cloud)
    {
        $this->care_cloud = $care_cloud;
    }

    public function __invoke(callable $handler): \Closure
    {
        $config = $this->care_cloud->getConfig();
        if ($config->getToken()) {
            $this->token = $config->getToken();
        }
        if ($config->getAuthType() === AuthTypes::BEARER_AUTH && !$this->token) {
            $body = new ActionsLoginBody1();
            $body->setLogin($config->getLogin())
                ->setPassword($config->getPassword())
                ->setUserExternalApplicationId($config->getExternalAppId());

            $api = new UsersApi(new Client(), $this->care_cloud->getDefaultConfiguration());
            $response = $api->postUserLogin($body);
            $this->token = $response->getData()->getBearerToken();
        }

        return function (RequestInterface $request, array $options) use ($handler) {
            if ($this->care_cloud->getConfig()->getAuthType() === AuthTypes::BEARER_AUTH) {
                return $handler(
                    $request->withHeader('Authorization', 'Bearer ' . $this->token),
                    $options
                );
            } else {
                return $handler($request, $options);
            }
        };
    }

    /**
     * @return ?string
     */
    public function getToken(): ?string
    {
        return $this->token;
    }
}
