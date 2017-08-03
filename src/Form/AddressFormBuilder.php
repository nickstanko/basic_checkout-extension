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
        'postal_code' => [
            'required' => true,
        ],
        'first_name'  => [
            'required' => true,
        ],
        'last_name'   => [
            'required' => true,
        ],
        'address1'    => [
            'required' => true,
        ],
        'address2',
        'country'     => [
            'required' => true,
            'config'   => [
                'mode' => 'dropdown',
            ],
        ],
        'state'       => [
            'required' => true,
            'config'   => [
                'mode' => 'dropdown',
            ],
        ],
        'city'        => [
            'required' => true,
        ],
    ];
}
