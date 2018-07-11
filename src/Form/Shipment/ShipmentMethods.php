<?php namespace Anomaly\BasicCheckoutExtension\Form\Shipment;

use Anomaly\CartsModule\Cart\Command\GetCart;
use Anomaly\CheckoutsModule\Checkout\CheckoutService;
use Anomaly\CheckoutsModule\Checkout\Contract\CheckoutRepositoryInterface;
use Anomaly\CartsModule\Cart\Contract\CartInterface;
use Anomaly\SelectFieldType\SelectFieldType;
use Anomaly\ShippingModule\Method\Contract\MethodInterface;
use Anomaly\ShippingModule\Shipping\ShippingResolver;
use Anomaly\ShippingModule\Shipping\Contract\ShippableInterface;
use Anomaly\StoreModule\Service\ServiceManager;
use Anomaly\Streams\Platform\Support\Currency;
use Anomaly\Streams\Platform\Support\Decorator;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Session\Store;

/**
 * Class ShipmentMethods
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ShipmentMethods
{

    use DispatchesJobs;

    /**
     * Handle the shipping options.
     *
     * @param SelectFieldType $fieldType
     * @param ShippingResolver $resolver
     * @param ServiceManager $manager
     * @param Currency $currency
     */
    public function handle(
        SelectFieldType $fieldType,
        ShippingResolver $resolver,
        ServiceManager $manager,
        Currency $currency,
        CheckoutRepositoryInterface $checkouts,
        Store $session
    ) {
        /* @var CheckoutService $checkout */
        $checkout = $manager->make('checkout');

        /* @var CartInterface $cart */
        $cartInterface = $checkouts->findByStrId($session->get('checkout'))->getCart();

        $methods = $resolver->resolve($address = $cartInterface->getShippingAddress());

        /* @var ShippableInterface $item */
        // @todo this should be an cart item
        $item = (new Decorator())->undecorate($this->dispatch(new GetCart())->getItems()->first()->entry);

        $options = array_combine(
            $methods->map(
                function ($method) use ($item, $address) {

                    /* @var MethodInterface $method */
                    return $method->getId();
                }
            )->all(),
            $methods->map(
                function ($method) use ($item, $address, $currency) {

                    try {
                        /* @var MethodInterface $method */
                        return [
                            'name'  => $method->getName(),
                            'quote' => $currency->normalize($method->quote($item, $address)),
                        ];
                    } catch (\Exception $exception) {
                        return [
                            'name' => $method->getName(),
                        ];
                    }
                }
            )->all()
        );

        $options = array_filter(
            $options,
            function (array $option) {
                return isset($option['quote']) && !empty($option['quote']);
            }
        );

        foreach ($options as &$option) {
            $option = $option['name'] . '(' . $currency->format($option['quote']) . ')';
        }

        $fieldType->setOptions($options);
    }
}
