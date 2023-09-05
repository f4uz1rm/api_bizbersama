Tata Cara Installasi API Biz Bersama : 

Tahap Pertama : Menghilangkan Public pada URL

Buka Route Tersebut : 
  // \vendor\laravel\framework\src\Illuminate\Routing\UrlGenerator.php

Lalu cari function asset, dan ganti dengan function dibawah ini : 

    /**
     * Generate an asset path for the application.
     *
     * @param  string  $path
     * @param  bool|null  $secure
     * @return string
     */
     ganti function asset dengan function dibawah ini :

 public function asset($path, $secure = null)
    {
        if ($this->isValidUrl($path)) {
            return $path;
        }

        // Once we get the root URL, we will check to see if it contains an index.php
        // file in the paths. If it does, we will remove it since it is not needed
        // for asset paths, but only for routes to endpoints in the application.
        // $root = $this->assetRoot ?: $this->formatRoot($this->formatScheme($secure));

        // return $this->removeIndex($root) . '/' . trim($path, '/');

        $root = $this->assetRoot
            ? $this->assetRoot
            : $this->formatRoot($this->formatScheme($secure));

        // Following 2 lines were added
        if ($_SERVER['REMOTE_ADDR'] != '127.0.0.1')
            $root .= '/public';

        return $this->removeIndex($root) . '/' . trim($path, '/');
    }