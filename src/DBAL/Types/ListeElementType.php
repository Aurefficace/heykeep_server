<?php
namespace App\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

final class ListeElementType extends AbstractEnumType
{
    public const TEXTE = 0;
    public const IMAGE = 1;
    public const LIEN = 2;

    protected static $choices = [
        self::TEXTE => 'Texte',
        self::IMAGE => 'Image',
        self::LIEN => 'Lien',
    ];
}