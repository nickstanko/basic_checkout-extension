<?php namespace Anomaly\BasicCheckoutExtension;

use Anomaly\BasicCheckoutExtension\Form\BillingFormBuilder;
use Anomaly\BasicCheckoutExtension\Form\CustomerFormBuilder;
use Anomaly\BasicCheckoutExtension\Form\ShippingFormBuilder;
use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

/**
 * Class BasicCheckoutExtensionServiceProvider
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class BasicCheckoutExtensionServiceProvider extends AddonServiceProvider
{

    /**
     * The addon bindings.
     *
     * @var array
     */
    protected $bindings = [
        'checkout.customer' => CustomerFormBuilder::class,
        'checkout.shipping' => ShippingFormBuilder::class,
        'checkout.billing'  => BillingFormBuilder::class,
    ];

    /**
     * The addon routes.
     *
     * @var array
     */
    protected $routes = [
        'checkout/address'       => 'Anomaly\BasicCheckoutExtension\Http\Controller\CheckoutController@address',
        'checkout/shipping'      => 'Anomaly\BasicCheckoutExtension\Http\Controller\CheckoutController@shipping',
        'checkout/billing'       => 'Anomaly\BasicCheckoutExtension\Http\Controller\CheckoutController@billing',
        'checkout/complete/{id}' => 'Anomaly\BasicCheckoutExtension\Http\Controller\CheckoutController@complete',
    ];
}
