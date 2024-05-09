<?php

namespace CrmCareCloud\Webservice\RestApi\Client\SDK;

use CrmCareCloud\Webservice\RestApi\Client\Api\AgreementsApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\BookingsApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\BookingStatusesApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\BookingTicketPropertiesApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\BookingTicketsApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\CampaignProductsApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\CampaignsApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\CardsApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\CardTypesApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\CommunicationChannelsApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\CountriesApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\CreditHistoryApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\CreditsApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\CreditTypesApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\CurrenciesApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\CustomerAddressTypesApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\CustomerExternalApplicationsApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\CustomerPropertiesApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\CustomerRelationTypesApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\CustomersActionsApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\CustomersApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\CustomerSourceRecordsApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\CustomerSourcesApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\CustomerTypesApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\EventGroupsApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\EventPropertiesApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\EventsApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\EventTypesApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\HintsApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\InterestsApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\LanguagesApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\MessagesApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\MessageTemplatesApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\OneTimePasswordApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\OrdersApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\PartnerPropertiesApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\PartnersApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\PointHistoryApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\PointReservationApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\PointsApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\PointTypesApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\ProductBrandsApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\ProductGroupsApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\ProductPropertiesApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\ProductRecommendationEngineApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\ProductReservationExternalListTypesApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\ProductReservationsApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\ProductReservationSourcesApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\ProductsApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\PurchaseItemTypesApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\PurchasesApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\PurchaseTypesApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\RecommendationsApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\ReservableProductsApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\RewardPropertiesApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\RewardsApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\RewardTypesApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\SegmentsApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\SkipassesApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\StatusesApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\StoreGroupsApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\StorePropertiesApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\StoresApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\TaskPropertiesApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\TasksApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\TestsApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\TokensApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\UserRolesApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\UsersApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\VoucherPropertiesApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\VouchersApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\WalletApi;
use CrmCareCloud\Webservice\RestApi\Client\ApiException;
use CrmCareCloud\Webservice\RestApi\Client\Configuration;
use CrmCareCloud\Webservice\RestApi\Client\Model\ActionsLoginBody1;
use CrmCareCloud\Webservice\RestApi\Client\Model\ModelInterface;
use CrmCareCloud\Webservice\RestApi\Client\SDK\Cache\Cache;
use CrmCareCloud\Webservice\RestApi\Client\SDK\Cache\CacheRequestMatcher;
use CrmCareCloud\Webservice\RestApi\Client\SDK\Data\AuthTypes;
use CrmCareCloud\Webservice\RestApi\Client\SDK\Data\Interfaces;
use DateTime;
use DateTimeZone;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;
use Kevinrob\GuzzleCache\CacheMiddleware;
use Kevinrob\GuzzleCache\Storage\Psr6CacheStorage;
use Kevinrob\GuzzleCache\Strategy\Delegate\DelegatingCacheStrategy;
use Kevinrob\GuzzleCache\Strategy\GreedyCacheStrategy;
use Kevinrob\GuzzleCache\Strategy\NullCacheStrategy;

class CareCloud
{
    private Config $config;

    /** @var AuthenticationHandler */
    private $auth_handler;

    private ?Cache $cache;

    private ?Configuration $default_configuration = null;

    public function __construct(Config $config, Cache $cache = null)
    {
        $this->config = $config;
        $this->cache = $cache;
    }

    /**
     * @return Configuration
     */
    public function getDefaultConfiguration(): Configuration
    {
        if ($this->default_configuration !== null) {
            return $this->default_configuration;
        }

        $url = trim($this->config->getProjectUri());

        $this->default_configuration = Configuration::getDefaultConfiguration()->setHost($url);
        $this->default_configuration->setBasicAuth($this->getConfig()->getAuthType() === AuthTypes::BASIC_AUTH)
            ->setBearerAuth($this->getConfig()->getAuthType() === AuthTypes::BEARER_AUTH)
            ->addUserAgent($this->getCareCloudUserAgent());

        if ($this->getConfig()->getAuthType() === AuthTypes::BASIC_AUTH) {
            $password = $this->config->getInterface() === Interfaces::ENTERPRISE ? $this->getHashedPassword() : $this->getConfig()->getPassword();
            $this->default_configuration->setUsername($this->config->getLogin());
            $this->default_configuration->setPassword($password);
        }

        return $this->default_configuration;
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        if (!$this->auth_handler instanceof AuthenticationHandler) {
            $this->auth_handler = new AuthenticationHandler($this);
        }
        $stack = HandlerStack::create(new CurlHandler());

        $stack->push($this->auth_handler);

        if (!empty($this->config->getMiddlewares())) {
            foreach ($this->config->getMiddlewares() as $middleware) {
                $stack->push($middleware);
            }
        }

        if ($this->cache instanceof Cache) {
            $strategy = new DelegatingCacheStrategy(new NullCacheStrategy());
            foreach ($this->cache->getRules() as $item) {
                $strategy->registerRequestMatcher(
                    new CacheRequestMatcher($item),
                    new GreedyCacheStrategy(
                        new Psr6CacheStorage($this->cache->getCacheItemPool()),
                        $item->getTtl()
                    )
                );
            }

            $stack->push(new CacheMiddleware($strategy));
        }

        return new Client(
            [
                'handler' => $stack,
            ]
        );
    }

    /**
     * @return Config
     */
    public function getConfig(): Config
    {
        return $this->config;
    }

    public function setConfig(Config $config): void
    {
        $this->config = $config;
        $this->default_configuration = null;
    }

    /**
     * @return AgreementsApi
     */
    public function agreementsApi(): AgreementsApi
    {
        return new AgreementsApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return BookingsApi
     */
    public function bookingsApi(): BookingsApi
    {
        return new BookingsApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return BookingTicketsApi
     */
    public function bookingTicketsApi(): BookingTicketsApi
    {
        return new BookingTicketsApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return BookingTicketPropertiesApi
     */
    public function bookingTicketsPropertiesApi(): BookingTicketPropertiesApi
    {
        return new BookingTicketPropertiesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return BookingStatusesApi
     */
    public function bookingStatusesApi(): BookingStatusesApi
    {
        return new BookingStatusesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return CreditsApi
     */
    public function creditsApi(): CreditsApi
    {
        return new CreditsApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return CreditHistoryApi
     */
    public function creditHistoryApi(): CreditHistoryApi
    {
        return new CreditHistoryApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return CreditTypesApi
     */
    public function creditTypesApi(): CreditTypesApi
    {
        return new CreditTypesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return CustomerAddressTypesApi
     */
    public function customerAddressTypesApi(): CustomerAddressTypesApi
    {
        return new CustomerAddressTypesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return TestsApi
     */
    public function testsApi(): TestsApi
    {
        return new TestsApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return CampaignsApi
     */
    public function campaignsApi(): campaignsApi
    {
        return new campaignsApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return CampaignProductsApi
     */
    public function campaignProductsApi(): CampaignProductsApi
    {
        return new CampaignProductsApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return \CrmCareCloud\Webservice\RestApi\Client\SDK\Extensions\CardsApi
     */
    public function cardsApi(): CardsApi
    {
        return new Extensions\CardsApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return CardTypesApi
     */
    public function cardTypesApi(): CardTypesApi
    {
        return new CardTypesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return CommunicationChannelsApi
     */
    public function communicationChannelsApi(): CommunicationChannelsApi
    {
        return new CommunicationChannelsApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return CountriesApi
     */
    public function countriesApi(): CountriesApi
    {
        return new CountriesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return CurrenciesApi
     */
    public function currenciesApi(): CurrenciesApi
    {
        return new CurrenciesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return Extensions\CustomersApi
     */
    public function customersApi(): CustomersApi
    {
        return new Extensions\CustomersApi($this->getClient(), $this->getDefaultConfiguration(), $this);
    }

    /**
     * @return CustomersActionsApi
     */
    public function customersActionsApi(): CustomersActionsApi
    {
        return new CustomersActionsApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return CustomerTypesApi
     */
    public function customerTypesApi(): CustomerTypesApi
    {
        return new CustomerTypesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return CustomerExternalApplicationsApi
     */
    public function customerExternalApplicationsApi(): CustomerExternalApplicationsApi
    {
        return new CustomerExternalApplicationsApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return CustomerPropertiesApi
     */
    public function customerPropertiesApi(): CustomerPropertiesApi
    {
        return new CustomerPropertiesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return CustomerRelationTypesApi
     */
    public function customerRelationTypesApi(): CustomerRelationTypesApi
    {
        return new CustomerRelationTypesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return CustomerSourcesApi
     */
    public function customerSourcesApi(): CustomerSourcesApi
    {
        return new CustomerSourcesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return CustomerSourceRecordsApi
     */
    public function customerSourceRecordsApi(): CustomerSourceRecordsApi
    {
        return new CustomerSourceRecordsApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return EventsApi
     */
    public function eventsApi(): EventsApi
    {
        return new EventsApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return EventGroupsApi
     */
    public function eventGroupsApi(): EventGroupsApi
    {
        return new EventGroupsApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return EventPropertiesApi
     */
    public function eventPropertiesApi(): EventPropertiesApi
    {
        return new EventPropertiesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return EventTypesApi
     */
    public function eventTypesApi(): EventTypesApi
    {
        return new EventTypesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return InterestsApi
     */
    public function interestsApi(): InterestsApi
    {
        return new InterestsApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return LanguagesApi
     */
    public function languagesApi(): LanguagesApi
    {
        return new LanguagesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return MessagesApi
     */
    public function messagesApi(): MessagesApi
    {
        return new MessagesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return MessageTemplatesApi
     */
    public function messageTemplatesApi(): MessageTemplatesApi
    {
        return new MessageTemplatesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return OrdersApi
     */
    public function ordersApi(): OrdersApi
    {
        return new OrdersApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return OneTimePasswordApi
     */
    public function oneTimePasswordApi(): OneTimePasswordApi
    {
        return new OneTimePasswordApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return PartnersApi
     */
    public function partnersApi(): PartnersApi
    {
        return new PartnersApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return PartnerPropertiesApi
     */
    public function partnerPropertiesApi(): PartnerPropertiesApi
    {
        return new PartnerPropertiesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return PointsApi
     */
    public function pointsApi(): PointsApi
    {
        return new PointsApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return PointReservationApi
     */
    public function pointReservationsApi(): PointReservationApi
    {
        return new PointReservationApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return PointTypesApi
     */
    public function pointTypesApi(): PointTypesApi
    {
        return new PointTypesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return PointHistoryApi
     */
    public function pointHistoryApi(): PointHistoryApi
    {
        return new PointHistoryApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return ProductsApi
     */
    public function productsApi(): ProductsApi
    {
        return new ProductsApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return ProductBrandsApi
     */
    public function productBrandsApi(): ProductBrandsApi
    {
        return new ProductBrandsApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return ProductGroupsApi
     */
    public function productGroupsApi(): ProductGroupsApi
    {
        return new ProductGroupsApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return ProductPropertiesApi
     */
    public function productPropertiesApi(): ProductPropertiesApi
    {
        return new ProductPropertiesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return ProductReservationExternalListTypesApi
     */
    public function productReservationExternalListTypesApi(): ProductReservationExternalListTypesApi
    {
        return new ProductReservationExternalListTypesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return ProductReservationsApi
     */
    public function productReservationsApi(): ProductReservationsApi
    {
        return new ProductReservationsApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return ProductReservationSourcesApi
     */
    public function productReservationSourcesApi(): ProductReservationSourcesApi
    {
        return new ProductReservationSourcesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return ReservableProductsApi
     */
    public function reservableProductsApi(): ReservableProductsApi
    {
        return new ReservableProductsApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return PurchasesApi
     */
    public function purchasesApi(): PurchasesApi
    {
        return new PurchasesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return PurchaseItemTypesApi
     */
    public function purchaseItemTypesApi(): PurchaseItemTypesApi
    {
        return new PurchaseItemTypesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return PurchaseTypesApi
     */
    public function purchaseTypesApi(): PurchaseTypesApi
    {
        return new PurchaseTypesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @deprecated use hintApi() method
     *
     * @return HintsApi
     */
    public function recommendationsApi(): HintsApi
    {
        return $this->hintApi();
    }

    /**
     * @return HintsApi
     */
    public function hintApi(): HintsApi
    {
        return new HintsApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @deprecated use productRecommendationEngineApi() method
     *
     * @return ProductRecommendationEngineApi
     */
    public function recommendationEngineApi(): ProductRecommendationEngineApi
    {
        return $this->productRecommendationEngineApi();
    }

    /**
     * @return ProductRecommendationEngineApi
     */
    public function productRecommendationEngineApi(): ProductRecommendationEngineApi
    {
        return new ProductRecommendationEngineApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return RewardsApi
     */
    public function rewardsApi(): RewardsApi
    {
        return new RewardsApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return RewardPropertiesApi
     */
    public function rewardPropertiesApi(): RewardPropertiesApi
    {
        return new RewardPropertiesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return RewardTypesApi
     */
    public function rewardTypesApi(): RewardTypesApi
    {
        return new RewardTypesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return SegmentsApi
     */
    public function segmentsApi(): SegmentsApi
    {
        return new SegmentsApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return SkipassesApi
     */
    public function skipassesApi(): SkipassesApi
    {
        return new SkipassesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return StatusesApi
     */
    public function statusesApi(): StatusesApi
    {
        return new StatusesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return StoresApi
     */
    public function storesApi(): StoresApi
    {
        return new StoresApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return StoreGroupsApi
     */
    public function storeGroupsApi(): StoreGroupsApi
    {
        return new StoreGroupsApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return StorePropertiesApi
     */
    public function storePropertiesApi(): StorePropertiesApi
    {
        return new StorePropertiesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return TokensApi
     */
    public function tokensApi(): TokensApi
    {
        return new TokensApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return UsersApi
     */
    public function usersApi(): UsersApi
    {
        return new UsersApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return UserRolesApi
     */
    public function userRolesApi(): UserRolesApi
    {
        return new UserRolesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return VoucherPropertiesApi
     */
    public function voucherPropertiesApi(): VoucherPropertiesApi
    {
        return new VoucherPropertiesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return VouchersApi
     */
    public function vouchersApi(): VouchersApi
    {
        return new VouchersApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return WalletApi
     */
    public function walletApi(): WalletApi
    {
        return new WalletApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return TasksApi
     */
    public function tasksApi(): TasksApi
    {
        return new TasksApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return TaskPropertiesApi
     */
    public function taskPropertiesApi(): TaskPropertiesApi
    {
        return new TaskPropertiesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return mixed
     * @throws ApiException
     * @throws \InvalidArgumentException|ApiException
     */
    public function getCountries()
    {
        $cache = $this->cache;
        if ($cache instanceof Cache) {
            if (!$cache->has('countries')) {
                $cache->set(
                    'countries',
                    $this->countriesApi()->getCountries(),
                    3600
                );
            }

            return $cache->get('countries');
        }

        return $this->countriesApi()->getCountries();
    }

    /**
     * @throws ApiException
     */
    public function authenticate(): ModelInterface
    {
        $body = new ActionsLoginBody1();
        $body
            ->setLogin($this->config->getLogin())
            ->setPassword($this->config->getPassword())
            ->setUserExternalApplicationId($this->config->getExternalAppId());

        $api = new UsersApi(new Client(), $this->getDefaultConfiguration());

        return $api->postUserLogin($body);
    }

    /**
     * @throws \Exception
     */
    public function getHashedPassword(): string
    {
        $dt = new DateTime('now', new DateTimeZone('UTC'));

        return hash('sha256', md5($this->config->getPassword()) . $dt->format("YmdH"));
    }

    /**
     * @return string
     */
    private function getCareCloudUserAgent(): string
    {
        return 'CareCloud SDK ' . SdkConfig::SDK_VERSION;
    }
}
