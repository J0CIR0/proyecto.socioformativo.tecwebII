<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\I18n\I18n;

class Auto extends Entity
{
    protected $_accessible = [
        'user_id' => true,
        'marca' => true,
        'modelo' => true,
        'tipo_combustible' => true,
        'estado' => true,
        'fecha_limite' => true,
        'descripcion_es' => true,
        'descripcion_en' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
    ];

    protected function _getDescripcion()
    {
        $locale = I18n::getLocale();
        if ($locale === 'en_US' && $this->descripcion_en) {
            return $this->descripcion_en;
        }
        return $this->descripcion_es ?: '';
    }
}
