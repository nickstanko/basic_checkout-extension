<?php namespace Anomaly\BasicCheckoutExtension\Form;

use Anomaly\CartsModule\Cart\Contract\CartInterface;
use Anomaly\CheckoutsModule\Checkout\Contract\CheckoutInterface;
use Anomaly\CheckoutsModule\Checkout\Contract\CheckoutRepositoryInterface;
use Anomaly\OrdersModule\Order\OrderModel;
use Anomaly\PaymentsModule\Account\AccountModel;
use Anomaly\PaymentsModule\Payment\Contract\PaymentInterface;
use Anomaly\PaymentsModule\Payment\PaymentModel;
use Anomaly\Streams\Platform\Message\MessageBag;
use Illuminate\Session\Store;

class PaymentFormHandler
{

    public function handle(
        PaymentFormBuilder $builder,
        CheckoutRepositoryInterface $checkouts,
        MessageBag $messages,
        Store $session
    ) {
        /* @var CheckoutInterface $checkout */
        $checkout = $checkouts->findByStrId($session->get('checkout'));

        /* @var CartInterface $cart */
        $cart = $checkout->getCart();

        /* @var PaymentInterface $payment */
        $payment = (new PaymentModel(
            array_merge(
                [
                    'account'  => AccountModel::where('slug', 'stripe')->first(),
                    'amount'   => $checkout->getCart()->getTotal(),
                    'currency' => 'USD',
                ],
                $builder->getFormValues()->all()
            )
        ));

        try {
            if ($result = $payment->purchase()) {

                $order = OrderModel::create(
                    [
                        'tax'        => $cart->getTax(),
                        'total'      => $cart->getTotal(),
                        'subtotal'   => $cart->getSubtotal(),
                        'discounts'  => $cart->getDiscounts(),
                        'first_name' => $cart->first_name,
                        'last_name'  => $cart->last_name,
                    ]
                );

                $checkout->order = $order;
                $checkout->save();

                $builder->setFormResponse(redirect('checkout/complete/' . $checkout->getStrId()));

                return;
            } else {
                $messages->error('Payment failed. Please try a different payment method.');

                $builder->setSave(false);
            }
        } catch (\Exception $e) {

            $messages->error('The card is expired!');

            $builder->setSave(false);

            return;
        }
    }
}
