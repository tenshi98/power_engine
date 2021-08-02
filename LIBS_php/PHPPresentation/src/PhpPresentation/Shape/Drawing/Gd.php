<?php

namespace PhpOffice\PhpPresentation\Shape\Drawing;

class Gd extends AbstractDrawingAdapter
{
    /* Rendering functions */
    public const RENDERING_DEFAULT = 'imagepng';
    public const RENDERING_PNG = 'imagepng';
    public const RENDERING_GIF = 'imagegif';
    public const RENDERING_JPEG = 'imagejpeg';

    /* MIME types */
    public const MIMETYPE_DEFAULT = 'image/png';
    public const MIMETYPE_PNG = 'image/png';
    public const MIMETYPE_GIF = 'image/gif';
    public const MIMETYPE_JPEG = 'image/jpeg';

    /**
     * Image resource.
     *
     * @var resource
     */
    protected $imageResource;

    /**
     * Rendering function.
     *
     * @var string
     */
    protected $renderingFunction = self::RENDERING_DEFAULT;

    /**
     * Mime type.
     *
     * @var string
     */
    protected $mimeType = self::MIMETYPE_DEFAULT;

    /**
     * Unique name.
     *
     * @var string
     */
    protected $uniqueName;

    /**
     * Gd constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->uniqueName = md5(rand(0, 9999) . time() . rand(0, 9999));
    }

    /**
     * Get image resource.
     *
     * @return resource
     */
    public function getImageResource()
    {
        return $this->imageResource;
    }

    /**
     * Set image resource.
     *
     * @param resource $value
     *
     * @return $this
     */
    public function setImageResource($value = null)
    {
        $this->imageResource = $value;

        if (!is_null($this->imageResource)) {
            // Get width/height
            $this->width = imagesx($this->imageResource);
            $this->height = imagesy($this->imageResource);
        }

        return $this;
    }

    /**
     * Get rendering function.
     *
     * @return string
     */
    public function getRenderingFunction()
    {
        return $this->renderingFunction;
    }

    /**
     * Set rendering function.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setRenderingFunction($value = self::RENDERING_DEFAULT)
    {
        $this->renderingFunction = $value;

        return $this;
    }

    /**
     * Get mime type.
     */
    public function getMimeType(): string
    {
        return $this->mimeType;
    }

    /**
     * Set mime type.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setMimeType($value = self::MIMETYPE_DEFAULT)
    {
        $this->mimeType = $value;

        return $this;
    }

    public function getContents(): string
    {
        ob_start();
        if (self::MIMETYPE_DEFAULT === $this->getMimeType()) {
            imagealphablending($this->getImageResource(), false);
            imagesavealpha($this->getImageResource(), true);
        }
        call_user_func($this->getRenderingFunction(), $this->getImageResource());
        $imageContents = ob_get_contents();
        ob_end_clean();

        return $imageContents;
    }

    public function getExtension(): string
    {
        $extension = strtolower($this->getMimeType());
        $extension = explode('/', $extension);
        $extension = $extension[1];

        return $extension;
    }

    public function getIndexedFilename(): string
    {
        return $this->uniqueName . $this->getImageIndex() . '.' . $this->getExtension();
    }

    /**
     * @var string
     */
    protected $path;

    /**
     * Get Path.
     */
    public function getPath(): string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }
}
