<?php

namespace App\Form;

use App\Entity\CryptoCurrency;
use App\Entity\Transaction;
use App\Entity\User;
use App\Service\CryptoCompareService;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TransactionType extends AbstractType
{
    private $cryptoCompareService;

    public function __construct(CryptoCompareService $cryptoCompareService)
    {
        $this->cryptoCompareService = $cryptoCompareService;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quantity')
            ->add('pricePerUnit', null, [
                'label' => 'Price Per Unit (€)',
                'attr' => [
                    'readonly' => true,
                ],
            ])
            ->add('transactionDate')
            ->add('cryptoCurrency', EntityType::class, [
                'class' => CryptoCurrency::class,
                'choice_label' => 'name', // Affiche le nom de la crypto-monnaie
            ])
            ->add('cryptoPrice', TextType::class, [
                'label' => 'Current Price Per Unit (€)',
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'readonly' => true,
                ],
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Transaction::class,
        ]);
    }
}
