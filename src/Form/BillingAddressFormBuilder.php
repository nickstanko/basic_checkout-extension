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
        'street_address' => [
            'required' => true,
        ],
        'city'           => [
            'required' => true,
        ],
        'state'          => [
            'required' => true,
            'config'   => [
                'mode' => 'dropdown',
            ],
        ],
        'postal_code'    => [
            'required' => true,
        ],
        'country'        => [
            'required' => true,
            'config'   => [
                'mode' => 'dropdown',
            ],
        ],
    ];
}
