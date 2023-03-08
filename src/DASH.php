<?php

/**
 * This file is part of the PHP-FFmpeg-video-streaming package.
 *
 * (c) Amin Yazdanpanah <contact@aminyazdanpanah.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Streaming;

use Streaming\Filters\AudioDASHFilter;
use Streaming\Filters\DASHFilter;
use Streaming\Filters\StreamFilterInterface;

class DASH extends Streaming
{
    /** @var bool */
    private $isVideo;

    /** @var string */
    private $adaption;

    /** @var string */
    private $seg_duration = 10;

    /** @var bool */
    private $generate_hls_playlist = false;

    /** @var int */
    private $use_timeline = 0;

    /** @var int */
    private $use_template = 0;

    /** @var bool */
    private $initSegName = false;

    /** @var bool */
    private $mediaSegName = false;

    /**
     * @param bool $isVideo
     * @return DASH
     */
    public function setIsVideo(bool $isVideo): DASH
    {
        $this->isVideo = $isVideo;
        return $this;
    }

    /**
     * @return bool
     */
    public function getIsVideo(): bool
    {
        return $this->isVideo;
    }

    /**
     * @return mixed
     */
    public function getAdaption()
    {
        return $this->adaption;
    }

    /**
     * @param mixed $adaption
     * @return DASH
     */
    public function setAdaption(string $adaption): DASH
    {
        $this->adaption = $adaption;
        return $this;
    }


    /**
     * @param int $useTimeline
     * @return DASH
     */
    public function setUseTimeLine(int $useTimeline): DASH
    {
        $this->use_timeline = $useTimeline;
        return $this;
    }

    /**
     * @return int
     */
    public function getUseTimeLine(): int
    {
        return $this->use_timeline;
    }

    /**
     * @param bool $initSegName
     * @return DASH
     */
    public function setInitSegName(bool $initSegName): DASH
    {
        $this->initSegName = $initSegName;
        return $this;
    }

    /**
     * @return bool
     */
    public function getInitSegName(): bool
    {
        return $this->initSegName;
    }

    /**
     * @param bool $mediaSegName
     * @return DASH
     */
    public function setMediaSegName(bool $mediaSegName): DASH
    {
        $this->mediaSegName = $mediaSegName;
        return $this;
    }

    /**
     * @return bool
     */
    public function getMediaSegName(): bool
    {
        return $this->mediaSegName;
    }

    /**
     * @param int $useTemplate
     * @return DASH
     */
    public function setUseTemplate(int $useTemplate): DASH
    {
        $this->use_template = $useTemplate;
        return $this;
    }

    /**
     * @return int
     */
    public function getUseTemplate(): int
    {
        return $this->use_template;
    }


    /**
     * @param string $seg_duration
     * @return DASH
     */
    public function setSegDuration(string $seg_duration): DASH
    {
        $this->seg_duration = $seg_duration;
        return $this;
    }

    /**
     * @return string
     */
    public function getSegDuration(): string
    {
        return $this->seg_duration;
    }

    /**
     * @param bool $generate_hls_playlist
     * @return DASH
     */
    public function generateHlsPlaylist(bool $generate_hls_playlist = true): DASH
    {
        $this->generate_hls_playlist = $generate_hls_playlist;
        return $this;
    }

    /**
     * @return bool
     */
    public function isGenerateHlsPlaylist(): bool
    {
        return $this->generate_hls_playlist;
    }

    /**
     * @return DASHFilter|AudioDASHFilter
     */
    protected function getFilter(): StreamFilterInterface
    {

        if($this->getIsVideo()) {
            return new DASHFilter($this);
        }

        return new AudioDASHFilter($this);
    }

    /**
     * @return string
     */
    protected function getPath(): string
    {
        return implode(".", [$this->getFilePath(), "mpd"]);
    }
}