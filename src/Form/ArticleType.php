<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ArticleType extends AbstractType
{
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
                'label' => $this->translator->trans('name', [], 'article')
            ])
            ->add('description', TextareaType::class, [
                'required' => true,
                'label' => $this->translator->trans('description', [], 'article'),
                'attr' => ['rows' => 5, 'cols' => 40]
            ])
            ->add('price', MoneyType::class, [
                'required' => true,
                'label' => $this->translator->trans('price', [], 'article'),
                'html5' => true
            ])
            ->add('image', FileType::class, [
                'required' => (!$builder->getData()->getId()) ? true : false,
                'label' => $this->translator->trans('image', [], 'article'),
                'mapped' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
