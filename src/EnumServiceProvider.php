<?php

namespace BenSampo\Enum;

use Lfyw\LfywEnum\Rules\EnumKey;
use Lfyw\LfywEnum\Rules\EnumValue;
use Illuminate\Support\ServiceProvider;
use BenSampo\Enum\Commands\MakeEnumCommand;

class EnumServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootCommands();
        $this->bootValidators();
    }

    /**
     * Boot the custom commands
     *
     * @return void
     */
    private function bootCommands()
    {
        $this->publishes([
            __DIR__.'/Commands/stubs' => $this->app->basePath('stubs')
        ], 'stubs');

        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeEnumCommand::class,
            ]);
        }
    }

    /**
     * Boot the custom validators
     *
     * @return void
     */
    private function bootValidators()
    {
        $this->app['validator']->extend('enum_key', function ($attribute, $value, $parameters, $validator) {
            $enum = $parameters[0] ?? null;

            return (new EnumKey($enum))->passes($attribute, $value);
        });

        $this->app['validator']->extend('enum_value', function ($attribute, $value, $parameters, $validator) {
            $enum = $parameters[0] ?? null;

            $strict = $parameters[1] ?? null;

            if (! $strict) {
                return (new EnumValue($enum))->passes($attribute, $value);
            }

            $strict = !! json_decode(strtolower($strict));

            return (new EnumValue($enum, $strict))->passes($attribute, $value);
        });
    }
}