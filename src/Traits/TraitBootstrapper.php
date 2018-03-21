<?php

namespace SD\Dumper\Traits;

/**
 * Trait TraitBootstrapper
 *
 * @package SD\Dumper\Traits
 */
trait TraitBootstrapper
{
    /**
     * @return void
     */
    protected function boot()
    {
        foreach (class_uses(static::class) as $trait) {
            $boot = 'boot'.substr(strrchr($trait, "\\"), 1);

            if (method_exists($this, $boot)) {
                call_user_func([$this, $boot]);
            }
        }
    }
}
