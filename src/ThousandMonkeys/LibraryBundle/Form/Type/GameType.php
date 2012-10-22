<?php
namespace ThousandMonkeys\LibraryBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class GameType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
		$builder->add('name');
		$builder->add('documents', 'collection', array('type' => new DocumentType(),
			'allow_add' => true,
        	'by_reference' => false
        ));
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'ThousandMonkeys\LibraryBundle\Entity\Game',
        );
    }

    public function getName()
    {
        return 'game';
    }

}
