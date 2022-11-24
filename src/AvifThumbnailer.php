<?php

/**
 *
 * @author MaximAL
 * @since 2022-11-24
 * @date 2022-11-24
 * @time 15:32
 * @copyright © MaximAL, Sijeko 2022
 * @link https://github.com/maximal/yii2-avif-thumbnailer
 */

namespace Maximal\Thumbnailers\Yii2;

use Imagine\Image\ImagineInterface;
use yii\base\InvalidParamException;
use yii\helpers\FileHelper;
use yii\imagine\Image;
use Yii;

class AvifThumbnailer extends \Maximal\Thumbnailers\AvifThumbnailer
{
	/**
	 * Path of thumbnail cache directory; it can contain Yii aliases such as `@webroot` or `@app`
	 */
	public static string $cachePathAlias = '@webroot/assets/thumbnails';

	/**
	 * URL of thumbnail cache directory; it can contain Yii aliases such as `@web`
	 */
	public static string $cacheUrlAlias = '@web/assets/thumbnails';

	/**
	 * @param string $path Path of the original image file; it can contain Yii aliases such as `@webroot` or `@app`
	 * @param int $width Width of generated thumbnail
	 * @param int $height Height of generated thumbnail
	 * @param bool $inset `true` for `THUMBNAIL_INSET` and `false` for `THUMBNAIL_OUTBOUND` mode
	 * @param array $options Key-value pairs of HTML attributes for the `&lt;img&gt;` tag
	 * @return string `&lt;picture&gt;` HTML tag with AVIF source and `&lt;img&gt;` fallback (thumbnail of initial type)
	 * @throws InvalidParamException
	 */
	public static function picture(
		string $path,
		int $width,
		int $height,
		bool $inset = true,
		array $options = []
	): string {
		$image = FileHelper::normalizePath(Yii::getAlias($path));
		static::$cachePath = Yii::getAlias(static::$cachePathAlias);
		static::$cacheUrl = Yii::getAlias(static::$cacheUrlAlias);

		return parent::picture($image, $width, $height, $inset, $options);
	}

	protected static function createImagine(): ImagineInterface
	{
		return Image::getImagine();
	}
}
