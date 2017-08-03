<?php namespace Anomaly\BasicCheckoutExtension\Form\Shipment;

use Anomaly\CartsModule\Cart\Command\GetCart;
use Anomaly\CheckoutsModule\Checkout\CheckoutService;
use Anomaly\SelectFieldType\SelectFieldType;
use Anomaly\ShippingModule\Method\Contract\MethodInterface;
use Anomaly\ShippingModule\Shipping\ShippingResolver;
use Anomaly\StoreModule\Contract\ShippableInterface;
use Anomaly\StoreModule\Service\ServiceManager;
use Anomaly\Streams\Platform\Support\Currency;
use Illuminate\Foundation\Bus\DispatchesJobs;

class ShipmentMethods
{

    use DispatchesJobs;

    public function handle(SelectFieldType $fieldType, ShippingResolver $resolver, ServiceManager $manager, Currency $currency)
    {
        /* @var CheckoutService $checkout */
        $checkout = $manager->make('checkout');

        $orderInterface = $checkout->order();

        $methods = $resolver->resolve($address = $orderInterface->getShippingAddress());

        /* @var ShippableInterface $item */
        $item = $this->dispatch(new GetCart())->getItems()->first()->entry;

        $fieldType->setOptions(
            array_combine(
                $methods->map(
                    function ($method) use ($item, $address) {

                        /* @var MethodInterface $method */
                        return $method->getId();
                    }
                )->all(),
                $methods->map(
                    function ($method) use ($item, $address, $currency) {

                        /* @var MethodInterface $method */
                        return $method->getName() . ' (' . $currency->format($method->quote($item, $address)) . ')';
                    }
                )->all()
            )
        );
    }
}
