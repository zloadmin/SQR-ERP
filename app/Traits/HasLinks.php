<?php
declare(strict_types=1);


namespace App\Traits;


trait HasLinks
{
    public function getEditLink(): string
    {
        return route('settings.' . $this->getModelPrefix() . '.edit', $this);
    }

    public function getModelPrefix()
    {
        return strtolower(class_basename(get_called_class()));
    }
}
