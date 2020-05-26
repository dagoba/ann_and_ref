<?php


namespace Budget\Service;


use Budget\Annotation\Validator\Length;

class ValidatorService
{
    use ContainerTrait;

    /** @var array */
    private $annotations;

    /**
     * @param string $field
     * @param $value
     * @return bool
     */
    public function validate(string $field, $value)
    {
        $this->annotations = $this->getContainer()['annotations'];

        $fieldAnnotation = $this->annotations[$field];

        if ($fieldAnnotation instanceof Length) {
            $value = mb_strlen($value);
            if ($value > $fieldAnnotation->max) {
                throw new \InvalidArgumentException($fieldAnnotation->maxMessage);
            }
            if ($value < $fieldAnnotation->min) {
                throw new \InvalidArgumentException($fieldAnnotation->minMessage);
            }
        }

        if ($fieldAnnotation instanceof EmptyValue) {
            throw new \InvalidArgumentException($fieldAnnotation->message);
        }

        return true;
    }
}