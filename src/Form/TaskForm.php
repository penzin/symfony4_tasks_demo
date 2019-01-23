<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Tasks\TaskPriority;
use App\Entity\Tasks\TaskState;
use App\Entity\Tags;
use App\Entity\Tasks;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Type;

/**
 * Форма для создания/редактирования информации о задаче
 */
class TaskForm extends AbstractType
{
    /**
     * Реализация билдера
     * 
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $nameDisabled = $options['isEdit'];
        $submitCaption = ($options['isEdit'] === true) ? 'Сохранить изменения' : 'Создать задачу';
        
        $builder
            ->add('name', TextType::class, [
                'label'     => 'Название',
                'disabled'  => $nameDisabled,
                'constraints'   => [
                    new NotBlank([
                        'message' => 'Поле не должно быть пустым!']),
                    new Length([
                        'min'           => 1,
                        'max'           => 100,
                        'minMessage'    => 'Допустимое количество символов: от 1 до 100!',
                        'maxMessage'    => 'Допустимое количество символов: от 1 до 100!',
                    ])
                ]
            ])
            
            ->add('priority', ChoiceType::class, [
                'label' => 'Приоритет',                
                'choices' => TaskPriority::getList(),
                'constraints'   => [
                    new Type([
                        'type'      => 'int',
                        'message'   => 'Неверное значение приоритета!'
                    ]),
                ]
            ])
            
            ->add('state', ChoiceType::class, [
                'label' => 'Статус', 
                'choices' => TaskState::getList(),
                'constraints'   => [
                    new Type([
                        'type'      => 'int',
                        'message'   => 'Неверное значение статуса!'
                    ]),
                ]                
                    
            ])
            
            ->add('idTag', EntityType::class, [
                'class'         => Tags::class,
                'label'         => 'Тэги',
                'choice_label'  => 'name',
                'multiple'      => true,
                'expanded'      => true,
                'choice_attr'   => ['class' => 'form-control'],
                'constraints'   => [
                    new Type([
                        'type'      => 'object',
                        'message'   => 'Неверное значение тегов!'
                    ]),
                ]
            ])
            
            ->add('save', SubmitType::class, [
                'label' => $submitCaption,
                 'attr' => ['class' => 'btn btn-success'],
            ]);
    }
    
    
    /**
     * Явно указываем класс сущности
     * 
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tasks::class,
            'isEdit'     => false,
        ]);
    }    
}
