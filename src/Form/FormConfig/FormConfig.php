<?php
/**
 * User: Nesly PETIT BERT
 * Date: 01/12/2019
 * Time: 21:12
 */

namespace App\Form\FormConfig;


use Symfony\Component\Form\AbstractType;

class FormConfig extends AbstractType
{

    private $required;

    private $label;

    private $placeholder;

    private $option;

    public function getRequired()
    {
        return $this->required;
    }

    /**
     * @param mixed $required
     * @return FormConfig
     */
    public function setRequired($required)
    {
        $this->required = $required;
        return $this;
    }

    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param mixed $label
     * @return FormConfig
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    public function getPlaceholder()
    {
        return $this->placeholder;
    }

    /**
     * @param mixed $placeholder
     * @return FormConfig
     */
    public function setPlaceholder($placeholder)
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOption()
    {
        return $this->option;
    }

    /**
     * @param mixed $option
     * @return FormConfig
     */
    public function setOption($option)
    {
        $this->option = $option;
        return $this;
    }


    /**
     * The default configuration of a field
     *
     * @param bool $required
     * @param string $label
     * @param string $placeholder
     *
     * @param array $options
     * @return array
     */
    protected function getFormConf($required, $label, $placeholder, $options = [])
    {
        return array_merge
        ([
            'required' => $required,
            'label' => $label,
            'attr' =>
                [
                    'placeholder' => $placeholder
                ]
        ], $options);
    }
}