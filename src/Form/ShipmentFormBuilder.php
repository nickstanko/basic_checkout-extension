<?php namespace Anomaly\BasicCheckoutExtension\Form;

use Anomaly\BasicCheckoutExtension\Form\Shipment\ShipmentMethods;
use Anomaly\CartsModule\Cart\Command\GetCart;
use Anomaly\CartsModule\Cart\Command\ProcessCart;
use Anomaly\CartsModule\Cart\Contract\CartInterface;
use Anomaly\CartsModule\Modifier\ModifierModel;
use Anomaly\ShippingModule\Method\Contract\MethodInterface;
use Anomaly\ShippingModule\Method\MethodModel;
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
    protected $model = null;

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
        /* @var CartInterface $cart */
        $cart = $this->dispatch(new GetCart());

        /* @var MethodInterface $method */
        $method = MethodModel::find($this->getPostValue('method'));

        // Delete old shipping charges.
        ModifierModel::where('type', 'shipping')->where('cart_id', $cart->getId())->delete();

        (new ModifierModel(
            [
                'type'  => 'shipping',
                'value' => $method->quote($cart->getItems()->first(), $cart->getShippingAddress()),
                'cart'  => $cart,
            ]
        ))->save();

        $this->dispatch(new ProcessCart($cart));

        $cart->save();
    }

}
