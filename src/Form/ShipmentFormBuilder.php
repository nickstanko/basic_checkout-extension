<?php namespace Anomaly\BasicCheckoutExtension\Form;

use Anomaly\BasicCheckoutExtension\Form\Shipment\ShipmentMethods;
use Anomaly\CartsModule\Cart\Command\GetCart;
use Anomaly\OrdersModule\Modifier\ModifierModel;
use Anomaly\OrdersModule\Order\Contract\OrderInterface;
use Anomaly\OrdersModule\Order\OrderModel;
use Anomaly\OrdersModule\Shipment\ShipmentModel;
use Anomaly\ShippingModule\Method\Contract\MethodInterface;
use Anomaly\ShippingModule\Method\MethodModel;
use Anomaly\StoreModule\Contract\ShippableInterface;
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

    public function onSaving()
    {
        $entry = $this->getFormEntry();

        /* @var OrderInterface $order */
        $order = OrderModel::find($this->getOption('order_id'));

        /* @var ShippableInterface $item */
        // @todo this should be an order item
        $item = $this->dispatch(new GetCart())->getItems()->first()->entry;

        /* @var MethodInterface $method */
        $method = MethodModel::find($this->getPostValue('method'));

        (new ModifierModel(
            [
                'type'  => 'shipping',
                'value' => $method->quote($item, $order->getShippingAddress()),
                //'entry' => $method,
                'order' => $order,
            ]
        ))->save();

        $order->save();
    }

}
