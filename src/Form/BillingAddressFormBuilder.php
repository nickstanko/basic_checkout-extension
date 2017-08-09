<?php namespace Anomaly\BasicCheckoutExtension\Form;

use Anomaly\CartsModule\Cart\CartModel;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class BillingAddressFormBuilder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class BillingAddressFormBuilder extends FormBuilder
{

    /**
     * The form model.
     *
     * @var string
     */
    protected $model = CartModel::class;

    /**
     * The form fields.
     *
     * @var array
     */
    protected $fields = [
        'billing_street_address' => [
            'required' => true,
        ],
        'billing_city'           => [
            'required' => true,
        ],
        'billing_state'          => [
            'required' => true,
            'config'   => [
                'mode' => 'dropdown',
            ],
        ],
        'billing_postal_code'    => [
            'required' => true,
        ],
        'billing_country'        => [
            'required' => true,
            'config'   => [
                'mode' => 'dropdown',
            ],
        ],
    ];
}
