<?php namespace Anomaly\BasicCheckoutExtension\Form;

use Anomaly\OrdersModule\Order\OrderModel;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class AddressFormBuilder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AddressFormBuilder extends FormBuilder
{

    /**
     * The form model.
     *
     * @var string
     */
    protected $model = OrderModel::class;

    /**
     * The form fields.
     *
     * @var array
     */
    protected $fields = [
        'shipping_first_name'     => [
            'required' => true,
        ],
        'shipping_last_name'      => [
            'required' => true,
        ],
        'shipping_street_address' => [
            'required' => true,
        ],
        'shipping_city'           => [
            'required' => true,
        ],
        'shipping_state'          => [
            'required' => true,
            'config'   => [
                'mode' => 'dropdown',
            ],
        ],
        'shipping_postal_code'    => [
            'required' => true,
        ],
        'shipping_country'        => [
            'required' => true,
            'config'   => [
                'mode' => 'dropdown',
            ],
        ],
    ];

    /**
     * The form buttons.
     *
     * @var array
     */
    protected $actions = [
        'submit',
    ];
}
