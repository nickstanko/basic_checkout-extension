<?php namespace Anomaly\BasicCheckoutExtension\Form;

use Anomaly\CheckoutsModule\Checkout\Contract\CheckoutInterface;
use Anomaly\CheckoutsModule\Checkout\Contract\CheckoutRepositoryInterface;
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
