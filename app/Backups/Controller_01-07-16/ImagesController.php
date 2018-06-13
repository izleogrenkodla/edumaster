<?php

/**
 * Images Controller
 * used for resizing images on the fly
 */
class ImagesController extends AppController
{
    var $name = 'Image';
    public $uses;
    // variables
    var $cache_dir = 'img/cache';
    var $error_img = 'img/error.png';
    var $types = array(1 => "gif", 2 => "jpeg", 3 => "png", 4 => "jpg");

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->uses = ucfirst($this->params['pass'][0]);
    }

    // new resize function
    function resize($width, $height, $id, $resize = true)
    {
        // get contender item
        $item = $this->$this->uses->read(null, $id);
            // save image path
        $path_rel = $item[$this->uses]['image_url'];
        // save full image path
        $path_ab = WWW_ROOT . substr($path_rel, 1, strlen($path_rel));
        // get resize boolean
        $resize = (($resize === 'false') ? FALSE : TRUE);

        // image doesn't exist
        if (!file_exists($path_ab) || empty($item)) {
            $this->output_error();
        }

        // get image details
        $details = getimagesize($path_ab);

        // if no resize required
        if (!$resize) {
            // get original file
            $data = file_get_contents($path_ab);
            // output to screen
            $this->output($data, $details['mime'], strlen($data));
        }


        // if either width or height is an asterix
        if ($width == '*' || $height == '*') {
            if ($height == '*') {
                // recalculate height
                $height = ceil($width / ($details[0] / $details[1]));
            } else {
                // recalculate width
                $width = ceil(($details[0] / $details[1]) * $height);
            }
        } else {
            if (($details[1] / $height) > ($details[0] / $width)) {
                $width = ceil(($details[0] / $details[1]) * $height);
            } else {
                $height = ceil($width / ($details[0] / $details[1]));
            }
        }

        // include folder in filename
        $dir_path = preg_replace("/[^a-z0-9_]/", "_", strtolower(dirname($path_rel)));
        $dir_path .= '-' . basename($path_rel);

        // create new file names
        $file_rel = $this->cache_dir . DS . $width . 'x' . $height . '_' . $dir_path;
        $file_cached = WWW_ROOT . $this->cache_dir . DS . $width . 'x' . $height . '_' . $dir_path;
        //echo "$path_rel : $dir_path : $file_rel";

        // init
        $cached = TRUE;

        // if cached file exists
        if (file_exists($file_cached)) {
            // get image sizes
            $csize = getimagesize($file_cached);
            // check that cached file is correct dimensions
            $cached = ($csize[0] == $width && $csize[1] == $height);
            // check file age
            if (@filemtime($file_cached) < @filemtime($path_ab)) {
                $cached = FALSE;
            }
        } else {
            $cached = FALSE;
        }


        // if cache file exists
        if ($cached) {
            // get cached file
            $data = file_get_contents($file_cached);
            // output
            $this->output($data, $details['mime'], strlen($data));
        }


        // switch on file type
        switch ($details[2]) {
            // deal with jpg file
            case 2:
                // get source file
                $source = imagecreatefromjpeg($path_ab);
                // create tmep image resource
                $temp = imagecreatetruecolor($width, $height);
                // resize the image
                imagecopyresampled($temp, $source, 0, 0, 0, 0, $width, $height, $details[0], $details[1]);
                // save the result to cache dir
                $success = imagejpeg($temp, $file_cached, 90);
                // destroy image resources
                imagedestroy($source);
                imagedestroy($temp);
                break;
        }

        // cache file created
        if ($success) {
            // get file contents
            $data = file_get_contents($file_cached);
            // output file
            $this->output($data, $details['mime'], strlen($data));
        } else {
            // display error image
            $this->output_error();
        }
    }

    // print error image
    function output_error()
    {
        // error image path
        $error_ab = WWW_ROOT . $this->error_img;
        // get error image
        $data = file_get_contents($error_ab);
        // output to screen
        $details = getimagesize($error_ab);
        // output error image
        $this->output($data, $details['mime'], strlen($data));
    }

    // output file to screen
    function output($data, $mime, $length)
    {
        // set content type
        header("Content-type: " . $mime);
        // set content length
        header("Content-Length: " . $length);
        // echo file data
        echo $data;
        // exit script
        exit();
    }


    /**
     * displays and resizes an image
     * @width    = width to resize image to
     * @height    = height to resize image to
     * @resize    = true/false
     * @src    = src dir of image from root
     */
    function admin_view()
    {
        // get params
        $width = $this->params['pass'][1];
        $height = $this->params['pass'][2];
        $noresize = $this->params['pass'][3];
        $id = $this->params['pass'][4];
        //$url = $this->_get_url($this->params['pass']);

        $item = ClassRegistry::init($this->uses)->read(null, $id);
        $this->set(compact('var'));

        if (!empty($item[$this->uses]['image_url']) && file_exists(WWW_ROOT . $item[$this->uses]['image_url'])) {
            $url = $item[$this->uses]['image_url'];
        } else {
            $url = $this->error_img;
        }

        // get full image path
        $full_path = WWW_ROOT . $url;

        // check file exists
        if (file_exists($full_path)) {
            // get size of image
            $size = getimagesize($full_path);
            // get mimetype
            $mime = $size['mime'];

            // if either width or height is an asterix
            if ($width == '*' || $height == '*') {
                if ($height == '*') {
                    // recalculate height
                    $height = ceil($width / ($size[0] / $size[1]));
                } else {
                    // recalculate width
                    $width = ceil(($size[0] / $size[1]) * $height);
                }
            } else {
                if (($size[1] / $height) > ($size[0] / $width)) {
                    $width = ceil(($size[0] / $size[1]) * $height);
                } else {
                    $height = ceil($width / ($size[0] / $size[1]));
                }
            }

            // include folder in filename
            $dir_path = preg_replace("/[^a-z0-9_]/", "_", strtolower(dirname($url)));
            $dir_path .= '-' . basename($url);

            // create new file names
            $file_relative = $this->cache_dir . '/' . $width . 'x' . $height . '_' . $dir_path;
            $file_cached = WWW_ROOT . $this->cache_dir . DS . $width . 'x' . $height . '_' . $dir_path;

            // if cached file already exists
            if (file_exists($file_cached)) {
                // get image sizes
                $csize = getimagesize($file_cached);
                // check that cached file is correct dimensions
                $cached = ($csize[0] == $width && $csize[1] == $height);
                // check file age
                if (@filemtime($cachefile) < @filemtime($url))
                    $cached = false;
            } else {
                $cached = false;
            }

            // if file not cached
            if (!$cached) {
                $resize = ($size[0] > $width || $size[1] > $height) || ($size[0] < $width || $size[1] < $height);
            } else {
                $resize = false;
            }

            // do not resize if set to true
            if ($noresize == 'true') {
                $resize = false;
                $cached = false;
            }

            // if image resize is necessary
            if ($resize) {
                // image
                $image = call_user_func('imagecreatefrom' . $this->types[$size[2]], $full_path);
                if (function_exists("imagecreatetruecolor") && ($temp = imagecreatetruecolor($width, $height))) {
                    imagecopyresampled($temp, $image, 0, 0, 0, 0, $width, $height, $size[0], $size[1]);
                } else {
                    $temp = imagecreate($width, $height);
                    imagecopyresized($temp, $image, 0, 0, 0, 0, $width, $height, $size[0], $size[1]);
                }
                call_user_func("image" . $this->types[$size[2]], $temp, $file_cached);
                imagedestroy($image);
                imagedestroy($temp);
            } elseif (!$cached) {
                // copy original file
                copy($full_path, $file_cached);
            }

            // get file contents
            $data = file_get_contents($file_cached);
        } else {
            $size = getimagesize($full_path);
            $mime = $size['mime'];
            $data = file_get_contents($full_path);
        }

        // set headers and output image
        header("Content-type: $mime");
        header('Content-Length: ' . strlen($data));
        echo $data;
        exit();
    }

    /**
     * displays and resizes an image
     * @width    = width to resize image to
     * @height    = height to resize image to
     * @resize    = true/false
     * @src    = src dir of image from root
     */
    function view()
    {
        // get params
        $width = $this->params['pass'][1];
        $height = $this->params['pass'][2];
        $noresize = $this->params['pass'][3];
        $id = $this->params['pass'][4];
        //$url = $this->_get_url($this->params['pass']);
        $item = ClassRegistry::init($this->uses)->read(null, $id);
        $this->set(compact('var'));
        // echo WWW_ROOT.$item[$this->uses]['image_url']; die;
        // $item = $this->User->read(null,$id);
        if (!empty($item[$this->uses]['image_url']) && file_exists(WWW_ROOT . $item[$this->uses]['image_url'])) {
            $url = $item[$this->uses]['image_url'];
        } else {
            $url = $this->error_img;
        }
        // get full image path

        $full_path = WWW_ROOT . $url;

        if (file_exists($full_path) && !empty($url)) {
            // get size of image
            $size = getimagesize($full_path);
            // get mimetype
            $mime = $size['mime'];

            // if either width or height is an asterix
            if ($width == '*' || $height == '*') {
                if ($height == '*') {
                    // recalculate height
                    $height = ceil($width / ($size[0] / $size[1]));
                } else {
                    // recalculate width
                    $width = ceil(($size[0] / $size[1]) * $height);
                }
            } else {
                if (($size[1] / $height) > ($size[0] / $width)) {
                    $width = ceil(($size[0] / $size[1]) * $height);
                } else {
                    $height = ceil($width / ($size[0] / $size[1]));
                }
            }
            // include folder in filename
            $dir_path = preg_replace("/[^a-z0-9_]/", "_", strtolower(dirname($url)));
            $dir_path .= '-' . basename($url);

            // create new file names
            $file_relative = $this->cache_dir . '/' . $width . 'x' . $height . '_' . $dir_path;
            $file_cached = WWW_ROOT . $this->cache_dir . DS . $width . 'x' . $height . '_' . $dir_path;

            // if cached file already exists
            if (file_exists($file_cached)) {
                // get image sizes
                $csize = getimagesize($file_cached);
                // check that cached file is correct dimensions
                $cached = ($csize[0] == $width && $csize[1] == $height);
                // check file age
                if (@filemtime($cachefile) < @filemtime($url))
                    $cached = false;
            } else {
                $cached = false;
            }

            // if file not cached
            if (!$cached) {
                $resize = ($size[0] > $width || $size[1] > $height) || ($size[0] < $width || $size[1] < $height);
            } else {
                $resize = false;
            }

            // do not resize if set to true
            if ($noresize == 'true') {
                $resize = false;
                $cached = false;
            }

            // if image resize is necessary
            if ($resize) {
                // image
                $image = call_user_func('imagecreatefrom' . $this->types[$size[2]], $full_path);
                if (function_exists("imagecreatetruecolor") && ($temp = imagecreatetruecolor($width, $height))) {
                    imagecopyresampled($temp, $image, 0, 0, 0, 0, $width, $height, $size[0], $size[1]);
                } else {
                    $temp = imagecreate($width, $height);
                    imagecopyresized($temp, $image, 0, 0, 0, 0, $width, $height, $size[0], $size[1]);
                }
                call_user_func("image" . $this->types[$size[2]], $temp, $file_cached);
                imagedestroy($image);
                imagedestroy($temp);
            } elseif (!$cached) {
                // copy original file
                copy($full_path, $file_cached);
            }
            // get file contents
            $data = file_get_contents($file_cached);

        } else {

            $size = getimagesize($full_path . $this->error_img);
            $mime = $size['mime'];
            $data = file_get_contents($full_path . $this->error_img);

        }

        // set headers and output image
        header("Content-type: $mime");
        header('Content-Length: ' . strlen($data));
        echo $data;
        exit();
    }


    /**
     * gets the url from the parameters
     */
    function _get_url($params)
    {
        // init
        $url = '';
        // unset unwanted params
        unset($params[0], $params[1], $params[2]);
        // loop through params
        foreach ($params as $p) {
            $url .= $p . '/';
        }
        // remove last slash
        $url = substr($url, 0, strrpos($url, '/'));
        return $url;
    }
}

?>
