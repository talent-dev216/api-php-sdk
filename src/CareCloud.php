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
use CrmCareCloud\Webservice\RestApi\Client\Api\CustomerEngagementApi;
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
use CrmCareCloud\Webservice\RestApi\Client\Api\PurchasePropertiesApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\PurchasesApi;
use CrmCareCloud\Webservice\RestApi\Client\Api\PurchaseTypesApi;
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
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;
use InvalidArgumentException;
use Kevinrob\GuzzleCache\CacheMiddleware;
use Kevinrob\GuzzleCache\Storage\Psr6CacheStorage;
use Kevinrob\GuzzleCache\Strategy\Delegate\DelegatingCacheStrategy;
use Kevinrob\GuzzleCache\Strategy\GreedyCacheStrategy;
use Kevinrob\GuzzleCache\Strategy\NullCacheStrategy;

class CareCloud
{
    /** @var Config */
    private Config $config;

    /** @var AuthenticationHandler */
    private $auth_handler;

    /** @var Cache|null */
    private ?Cache $cache;

    /** @var Configuration|null */
    private ?Configuration $default_configuration = null;

    /**
     * @param Config $config
     * @param Cache|null $cache
     */
    public function __construct(Config $config, Cache $cache = null)
    {
        $this->config = $config;
        $this->cache = $cache;
    }

    /**
     * @return Configuration
     * @throws Exception
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

    /**
     * @param Config $config
     * @return void
     */
    public function setConfig(Config $config): void
    {
        $this->config = $config;
        $this->default_configuration = null;
    }

    /**
     * @return AgreementsApi
     * @throws Exception
     */
    public function agreementsApi(): AgreementsApi
    {
        return new AgreementsApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return BookingsApi
     * @throws Exception
     */
    public function bookingsApi(): BookingsApi
    {
        return new BookingsApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return BookingTicketsApi
     * @throws Exception
     */
    public function bookingTicketsApi(): BookingTicketsApi
    {
        return new BookingTicketsApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return BookingTicketPropertiesApi
     * @throws Exception
     */
    public function bookingTicketsPropertiesApi(): BookingTicketPropertiesApi
    {
        return new BookingTicketPropertiesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return BookingStatusesApi
     * @throws Exception
     */
    public function bookingStatusesApi(): BookingStatusesApi
    {
        return new BookingStatusesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return CreditsApi
     * @throws Exception
     */
    public function creditsApi(): CreditsApi
    {
        return new CreditsApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return CreditHistoryApi
     * @throws Exception
     */
    public function creditHistoryApi(): CreditHistoryApi
    {
        return new CreditHistoryApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return CreditTypesApi
     * @throws Exception
     */
    public function creditTypesApi(): CreditTypesApi
    {
        return new CreditTypesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return CustomerAddressTypesApi
     * @throws Exception
     */
    public function customerAddressTypesApi(): CustomerAddressTypesApi
    {
        return new CustomerAddressTypesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return CustomerEngagementApi
     * @throws Exception
     */
    public function customerEngagementApi(): CustomerEngagementApi
    {
        return new CustomerEngagementApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return TestsApi
     * @throws Exception
     */
    public function testsApi(): TestsApi
    {
        return new TestsApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return CampaignsApi
     * @throws Exception
     */
    public function campaignsApi(): campaignsApi
    {
        return new campaignsApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return CampaignProductsApi
     * @throws Exception
     */
    public function campaignProductsApi(): CampaignProductsApi
    {
        return new CampaignProductsApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return \CrmCareCloud\Webservice\RestApi\Client\SDK\Extensions\CardsApi
     * @throws Exception
     */
    public function cardsApi(): CardsApi
    {
        return new Extensions\CardsApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return CardTypesApi
     * @throws Exception
     */
    public function cardTypesApi(): CardTypesApi
    {
        return new CardTypesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return CommunicationChannelsApi
     * @throws Exception
     */
    public function communicationChannelsApi(): CommunicationChannelsApi
    {
        return new CommunicationChannelsApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return CountriesApi
     * @throws Exception
     */
    public function countriesApi(): CountriesApi
    {
        return new CountriesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return CurrenciesApi
     * @throws Exception
     */
    public function currenciesApi(): CurrenciesApi
    {
        return new CurrenciesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return Extensions\CustomersApi
     * @throws Exception
     */
    public function customersApi(): CustomersApi
    {
        return new Extensions\CustomersApi($this->getClient(), $this->getDefaultConfiguration(), $this);
    }

    /**
     * @return CustomersActionsApi
     * @throws Exception
     */
    public function customersActionsApi(): CustomersActionsApi
    {
        return new CustomersActionsApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return CustomerTypesApi
     * @throws Exception
     */
    public function customerTypesApi(): CustomerTypesApi
    {
        return new CustomerTypesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return CustomerExternalApplicationsApi
     * @throws Exception
     */
    public function customerExternalApplicationsApi(): CustomerExternalApplicationsApi
    {
        return new CustomerExternalApplicationsApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return CustomerPropertiesApi
     * @throws Exception
     */
    public function customerPropertiesApi(): CustomerPropertiesApi
    {
        return new CustomerPropertiesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return CustomerRelationTypesApi
     * @throws Exception
     */
    public function customerRelationTypesApi(): CustomerRelationTypesApi
    {
        return new CustomerRelationTypesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return CustomerSourcesApi
     * @throws Exception
     */
    public function customerSourcesApi(): CustomerSourcesApi
    {
        return new CustomerSourcesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return CustomerSourceRecordsApi
     * @throws Exception
     */
    public function customerSourceRecordsApi(): CustomerSourceRecordsApi
    {
        return new CustomerSourceRecordsApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return EventsApi
     * @throws Exception
     */
    public function eventsApi(): EventsApi
    {
        return new EventsApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return EventGroupsApi
     * @throws Exception
     */
    public function eventGroupsApi(): EventGroupsApi
    {
        return new EventGroupsApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return EventPropertiesApi
     * @throws Exception
     */
    public function eventPropertiesApi(): EventPropertiesApi
    {
        return new EventPropertiesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return EventTypesApi
     * @throws Exception
     */
    public function eventTypesApi(): EventTypesApi
    {
        return new EventTypesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return InterestsApi
     * @throws Exception
     */
    public function interestsApi(): InterestsApi
    {
        return new InterestsApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return LanguagesApi
     * @throws Exception
     */
    public function languagesApi(): LanguagesApi
    {
        return new LanguagesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return MessagesApi
     * @throws Exception
     */
    public function messagesApi(): MessagesApi
    {
        return new MessagesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return MessageTemplatesApi
     * @throws Exception
     */
    public function messageTemplatesApi(): MessageTemplatesApi
    {
        return new MessageTemplatesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return OrdersApi
     * @throws Exception
     */
    public function ordersApi(): OrdersApi
    {
        return new OrdersApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return OneTimePasswordApi
     * @throws Exception
     */
    public function oneTimePasswordApi(): OneTimePasswordApi
    {
        return new OneTimePasswordApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return PartnersApi
     * @throws Exception
     */
    public function partnersApi(): PartnersApi
    {
        return new PartnersApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return PartnerPropertiesApi
     * @throws Exception
     */
    public function partnerPropertiesApi(): PartnerPropertiesApi
    {
        return new PartnerPropertiesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return PointsApi
     * @throws Exception
     */
    public function pointsApi(): PointsApi
    {
        return new PointsApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return PointReservationApi
     * @throws Exception
     */
    public function pointReservationsApi(): PointReservationApi
    {
        return new PointReservationApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return PointTypesApi
     * @throws Exception
     */
    public function pointTypesApi(): PointTypesApi
    {
        return new PointTypesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return PointHistoryApi
     * @throws Exception
     */
    public function pointHistoryApi(): PointHistoryApi
    {
        return new PointHistoryApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return ProductsApi
     * @throws Exception
     */
    public function productsApi(): ProductsApi
    {
        return new ProductsApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return ProductBrandsApi
     * @throws Exception
     */
    public function productBrandsApi(): ProductBrandsApi
    {
        return new ProductBrandsApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return ProductGroupsApi
     * @throws Exception
     */
    public function productGroupsApi(): ProductGroupsApi
    {
        return new ProductGroupsApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return ProductPropertiesApi
     * @throws Exception
     */
    public function productPropertiesApi(): ProductPropertiesApi
    {
        return new ProductPropertiesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return ProductReservationExternalListTypesApi
     * @throws Exception
     */
    public function productReservationExternalListTypesApi(): ProductReservationExternalListTypesApi
    {
        return new ProductReservationExternalListTypesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return ProductReservationsApi
     * @throws Exception
     */
    public function productReservationsApi(): ProductReservationsApi
    {
        return new ProductReservationsApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return ProductReservationSourcesApi
     * @throws Exception
     */
    public function productReservationSourcesApi(): ProductReservationSourcesApi
    {
        return new ProductReservationSourcesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return ReservableProductsApi
     * @throws Exception
     */
    public function reservableProductsApi(): ReservableProductsApi
    {
        return new ReservableProductsApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return PurchasesApi
     * @throws Exception
     */
    public function purchasesApi(): PurchasesApi
    {
        return new PurchasesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return PurchaseItemTypesApi
     * @throws Exception
     */
    public function purchaseItemTypesApi(): PurchaseItemTypesApi
    {
        return new PurchaseItemTypesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return PurchaseTypesApi
     * @throws Exception
     */
    public function purchaseTypesApi(): PurchaseTypesApi
    {
        return new PurchaseTypesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @deprecated use hintApi() method
     *
     * @return HintsApi
     * @throws Exception
     */
    public function recommendationsApi(): HintsApi
    {
        return $this->hintApi();
    }

    /**
     * @return HintsApi
     * @throws Exception
     */
    public function hintApi(): HintsApi
    {
        return new HintsApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @deprecated use productRecommendationEngineApi() method
     *
     * @return ProductRecommendationEngineApi
     * @throws Exception
     */
    public function recommendationEngineApi(): ProductRecommendationEngineApi
    {
        return $this->productRecommendationEngineApi();
    }

    /**
     * @return ProductRecommendationEngineApi
     * @throws Exception
     */
    public function productRecommendationEngineApi(): ProductRecommendationEngineApi
    {
        return new ProductRecommendationEngineApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return RewardsApi
     * @throws Exception
     */
    public function rewardsApi(): RewardsApi
    {
        return new RewardsApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return RewardPropertiesApi
     * @throws Exception
     */
    public function rewardPropertiesApi(): RewardPropertiesApi
    {
        return new RewardPropertiesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return RewardTypesApi
     * @throws Exception
     */
    public function rewardTypesApi(): RewardTypesApi
    {
        return new RewardTypesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return SegmentsApi
     * @throws Exception
     */
    public function segmentsApi(): SegmentsApi
    {
        return new SegmentsApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return SkipassesApi
     * @throws Exception
     */
    public function skipassesApi(): SkipassesApi
    {
        return new SkipassesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return StatusesApi
     * @throws Exception
     */
    public function statusesApi(): StatusesApi
    {
        return new StatusesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return StoresApi
     * @throws Exception
     */
    public function storesApi(): StoresApi
    {
        return new StoresApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return StoreGroupsApi
     * @throws Exception
     */
    public function storeGroupsApi(): StoreGroupsApi
    {
        return new StoreGroupsApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return StorePropertiesApi
     * @throws Exception
     */
    public function storePropertiesApi(): StorePropertiesApi
    {
        return new StorePropertiesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return TokensApi
     * @throws Exception
     */
    public function tokensApi(): TokensApi
    {
        return new TokensApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return UsersApi
     * @throws Exception
     */
    public function usersApi(): UsersApi
    {
        return new UsersApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return UserRolesApi
     * @throws Exception
     */
    public function userRolesApi(): UserRolesApi
    {
        return new UserRolesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return VoucherPropertiesApi
     * @throws Exception
     */
    public function voucherPropertiesApi(): VoucherPropertiesApi
    {
        return new VoucherPropertiesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return VouchersApi
     * @throws Exception
     */
    public function vouchersApi(): VouchersApi
    {
        return new VouchersApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return WalletApi
     * @throws Exception
     */
    public function walletApi(): WalletApi
    {
        return new WalletApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return TasksApi
     * @throws Exception
     */
    public function tasksApi(): TasksApi
    {
        return new TasksApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return TaskPropertiesApi
     * @throws Exception
     */
    public function taskPropertiesApi(): TaskPropertiesApi
    {
        return new TaskPropertiesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return PurchasePropertiesApi
     * @throws Exception
     */
    public function purchasePropertiesApi(): PurchasePropertiesApi
    {
        return new PurchasePropertiesApi($this->getClient(), $this->getDefaultConfiguration());
    }

    /**
     * @return mixed
     * @throws ApiException
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function getCountries(): mixed
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
     * @throws Exception
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
     * @throws Exception
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
