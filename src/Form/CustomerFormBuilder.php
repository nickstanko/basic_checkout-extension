<?php namespace Anomaly\BasicCheckoutExtension\Form;

use Anomaly\CartsModule\Cart\CartModel;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class CustomerFormBuilder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class CustomerFormBuilder extends FormBuilder
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
        'shipping_first_name'     => [
            'name' => 'First Name',
            'type' => 'anomaly.field_type.text',
            'required' => true,
        ],
        'shipping_last_name'      => [
            'name' => 'Last Name',
            'type' => 'anomaly.field_type.text',
            'required' => true,
        ],
        'shipping_street_address' => [
            'name' => 'Street Address',
            'type' => 'anomaly.field_type.text',
            'required' => true,
        ],
        'shipping_city'           => [
            'name' => 'City',
            'type' => 'anomaly.field_type.text',
            'required' => true,
        ],
        'shipping_state'          => [
            'name' => 'State',
            'type' => 'anomaly.field_type.state',
            'required' => true,
            'config'   => [
                'mode' => 'dropdown',
            ],
        ],
        'shipping_postal_code'    => [
            'name' => 'Zip Code',
            'type' => 'anomaly.field_type.text',
            'required' => true,
        ],
        'shipping_country'        => [
            'name' => 'Country',
            'type' => 'anomaly.field_type.country',
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
