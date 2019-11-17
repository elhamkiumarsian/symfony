<?php
namespace App\Annotations;

/**
 * @Annotation
 * @Target("ALL")
 */
class InternalUser {
    /** @Required 
     *  @Enum({"Employess", "Contractor"})
     */
    public $type;
} 