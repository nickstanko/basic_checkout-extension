<?php namespace Anomaly\BasicCheckoutExtension\Form;

use Anomaly\OrdersModule\Order\OrderModel;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class ShippingFormBuilder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ShippingFormBuilder extends FormBuilder
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
//        'shipping_method' => [
//            'required' => true,
//        ],
    ];
}
