<?php

namespace Kompo;

use Kompo\Elements\Block;

class Img extends Block
{
    public $vueComponent = 'Img';
    public $bladeComponent = 'Img';

    public $src;

    /**
     * The specified disk for uploaded files.
     * By default (see config file), it is stored in the 'local' disk for _File() and 'public' disk for _Image().
     */
    protected $disk;

    protected $originalSrc;

    protected function initialize($label)
    {
        $this->disk = config('kompo.default_storage_disk.image');

        $this->originalSrc = $label;

        parent::initialize('');
    }

    public function prepareForDisplay($komponent)
    {
        if(!$this->config('alt')) $this->alt($this->originalSrc); //To avoid breadking change - to deprecate in v4
        if (!$this->src) $this->src($this->originalSrc); //To avoid breadking change - to deprecate in v4->);

        return parent::prepareForDisplay($komponent);
    }

    //TODO Document
    public function bgCover($bgPosition = 'center')
    {
        $this->vueComponent = 'ImgCover';

        return $this->config([
            'bgPosition' => $bgPosition,
        ]);
    }

    /** TODO DOCUMENT
     * Sets the disk where the image was stored.
     * By default (see config file), it is stored in the 'public' disk for _Image().
     *
     * @param string $disk The disk instance key.
     *
     * @return self
     */
    public function disk($disk)
    {
        $this->disk = $disk;

        return $this;
    }

    //TODO Document
    public function src($src)
    {
        $this->src = filter_var($src, FILTER_VALIDATE_URL) ? $src : 
            (\Storage::disk($this->disk)->exists($src) ? \Storage::url($src) : asset($src));

        return $this;
    }

    //TODO Document
    public function alt($alt)
    {
        return $this->config([
            'alt' => $alt,
        ]);
    }

    public function __toHtml()
    {
        return '<img src="'.$this->src.'"'.
            ($this->class() ? (' class="'.$this->class().'"') : '').
            ($this->style() ? (' style="'.$this->style().'"') : '').
            collect($this->config('attrs'))->map(
                fn ($attrVal, $attrKey) => ' '.$attrKey.'="'.$attrVal.'"'
            )->implode('').
        '/>';
    }
}
