<?php namespace Anomaly\BasicCheckoutExtension\Form;

use Anomaly\BasicCheckoutExtension\Form\Shipment\ShipmentMethods;
use Anomaly\OrdersModule\Shipment\ShipmentModel;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class ShipmentFormBuilder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ShipmentFormBuilder extends FormBuilder
{

    /**
     * The form model.
     *
     * @var string
     */
    protected $model = ShipmentModel::class;

    /**
     * The form fields.
     *
     * @var array
     */
    protected $fields = [
        'method' => [
            'required' => true,
            'type'     => 'anomaly.field_type.select',
            'config'   => [
                'handler' => ShipmentMethods::class . '@handle',
            ],
        ],
    ];

    public function onReady()
    {

    }

}
