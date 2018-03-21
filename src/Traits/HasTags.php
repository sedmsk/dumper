<?php

namespace SD\Dumper\Traits;

/**
 * Trait HasTags
 *
 * @method static static getInstance() Получить экземпляр singleton класса
 *
 * @package SD\Dumper\Traits
 */
trait HasTags
{
    /**
     * @var string $tag Тег
     */
    protected $tag = '';

    /**
     * @var string $tagOnce Одноразовый тег
     */
    protected $tagOnce = '';

    /**
     * Установка тега
     *
     * @param string $tag Тег
     * @param bool $once Установить одноразовый/постоянный тег
     *
     * @return static
     */
    public static function setTag(string $tag = '', bool $once = false): self
    {
        $instance = static::getInstance();

        $var = 'tag'.($once ? 'Once' : '');

        $instance->{$var} = $tag;

        return $instance;
    }

    /**
     * Установка одноразового тега
     *
     * @param string $tag Тег
     *
     * @return static
     */
    public static function setTagOnce(string $tag = ''): self
    {
        return static::setTag($tag, true);
    }

    /**
     * @return string
     */
    public static function getTag(): string
    {
        $instance = static::getInstance();

        return $instance->tagOnce ?: $instance->tag;
    }

    /**
     * Удаление тега
     *
     * @param bool $once Удалить одноразовый/постоянный тег
     *
     * @return static
     */
    public static function unsetTag(bool $once = false): self
    {
        return static::setTag('', $once);
    }
}
