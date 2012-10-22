<?php
namespace ThousandMonkeys\LibraryBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class DocumentType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
		$builder->add('name', 
                      'text', 
                      array(
                            'label' => 'Document Name',
                            'data' => 'Core Rules'));
		$builder->add('versions', 'collection', array('type' => new VersionType(),
			'allow_add' => true,
        	'by_reference' => false
        ));
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'ThousandMonkeys\LibraryBundle\Entity\Document',
        );
    }

    public function getName()
    {
        return 'document';
    }

}
