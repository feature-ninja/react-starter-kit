<?php

declare(strict_types=1);

namespace Marketing\View\Components;

use FeatureNinja\Cva\ClassVarianceAuthority;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use function fn\cva;

final class Button extends Component
{
    public function __construct(
        public string $href,
        public ?string $variant = null,
    ) {}

    public function render(): View
    {
        return view()->file(__DIR__.'/button.blade.php', [
            'classNames' => self::cva()([
                'variant' => $this->variant,
            ]),
        ]);
    }

    private static function cva(): ClassVarianceAuthority
    {
        return once(fn () => cva(
            'inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] rounded-sm text-sm leading-normal',
            [
                'variants' => [
                    'variant' => [
                        'outline' => 'border-[#19140035] hover:border-[#1915014a] border dark:border-[#3E3E3A] dark:hover:border-[#62605b] ',
                        'solid' => 'border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A]',
                    ],
                ],
                'defaultVariants' => [
                    'variant' => 'solid',
                ],
            ],
        ));
    }
}
