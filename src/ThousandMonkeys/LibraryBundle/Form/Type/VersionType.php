<?php
namespace ThousandMonkeys\LibraryBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class VersionType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
		$builder->add('versionName',
                      'text', 
                      array(
                            'label' => 'Version Name',
                            'data' => '1'
                            ))
    			->add('file');
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'ThousandMonkeys\LibraryBundle\Entity\Version',
        );
    }

    public function getName()
    {
        return 'version';
    }

}
