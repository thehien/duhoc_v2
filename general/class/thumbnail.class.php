<?php
$files_mime = "image/gif,image/png,image/jpg,image/pjpeg,image/jpeg,,image/pdf,image/bmp";
$extension = "gif,png,jpeg,jpg,jpe,pdf,bmp";
$max_size = "2197152";
class Thumbnail {
	
	# Added var definitions  by Elpidio Latorilla 2003-07-13 
	var $source;
	var $max_width;
	var $max_height;

    // Set destination filename
	function setImgSource( $source ){
		$this->source = $source;
	}

	// Set maximum size of thumbnail
	function setMaxSize ( $max_width = 0, $max_height = 0 ){
		$this->max_width = $max_width;
		$this->max_height = $max_height;
	}

	// Get info about original image
	function getImageData( $data ){
		$size = GetImageSize( $this->source );
		switch ( $data ){
    	case 'width':
    		return $size[0];
    		break;
    	case 'height':
    		return $size[1];
    		break;
    	case 'type':
    		switch ( $size[2] ){
  			case 1:
  				return 'gif';
  				break;
  			case 2:
  				return 'jpg';
  				break;
  			case 3:
  				return 'png';
  				break;
  			}
     		break;
    	}
	}

	// Get info about thumbnail chi thu chieu rong
   /* function getThumbData($data){
        // Modified by Quynh, <!--WB:DTS-->10/16/2005 12:06 AM<!---->
        $w=$this->GetImageData('width');
        $h=$this->GetImageData('height');
		$w_ratio = $this->max_width  / $w;
		$h_ratio = $this->max_height / $h;

        if($this->max_width>0 && $this->max_height>0){
            if($w>$this->max_width){
                $width=$this->max_width;
                $height=round($h*$w_ratio,0);
            }else{
                $width=$w;
                $height=$h;
            }
        }elseif($this->max_width>0){
            if($w>$this->max_width){
                $width=$this->max_width;
                $height=round($h*$w_ratio,0);
            }else{
                $width=$w;
                $height=$h;
            }
        }else{
            if($h>$this->max_height){
                $height=$this->max_height;
                $width=round($w*$h_ratio,0);
            }else{
                $height=$h;
                $width=$w;
            }
        }
		switch ( $data ){
    	case 'width':
    		return $width;
    		break;
    	case 'height':
    		return $height;
    		break;
    	}
    }*/
  /*thu loc dieu kien*/
    function getThumbData( $data )
		{
		$w_ratio = $this->max_width  / $this->GetImageData('width');
		$h_ratio = $this->max_height / $this->GetImageData('height');

		if ( $h_ratio < $w_ratio )
			{
			$height = $this->max_height;
			$width = round( $this->GetImageData('width') * $h_ratio, 0);
			}
		else
			{
			$width = $this->max_width;
			$height = round( $this->GetImageData('height') * $w_ratio, 0);
			}

		switch ( $data )
			{
			case 'width':
				return $width;
				break;
			case 'height':
				return $height;
				break;
			}
		} 


	// Creating a thumbnail
	function Create( $dest='' ){
        //S** Quynh, <!--WB:DTS-->10/16/2005 12:06 AM<!---->
        $width=$this->GetThumbData('width');
        $height=$this->GetThumbData('height');
        /*if($this->max_width>0 && $this->max_height>0){
            if($height>$this->max_height)$height=$this->max_height;
        }*/
        //E**
		# Modified by Elpidio Latorilla 2003-07-13
		if(function_exists("ImageCreateTrueColor"))
            //$img_des = @ImageCreateTrueColor ( $this->GetThumbData('width'), $this->GetThumbData('height') );
            $img_des = @ImageCreateTrueColor ($width,$height);
		else $img_des = ImageCreate( $this->GetThumbData('width'), $this->GetThumbData('height') );

        switch ( $this->GetImageData('type') ){

    	case 'gif':
    		$img_src = ImageCreateFromGIF ( $this->source );
    		break;

    	case 'jpg':
    		$img_src = ImageCreateFromJPEG ( $this->source );
    		break;

    	case 'png':
    		$img_src = ImageCreateFromPNG ( $this->source );
    		break;
    	}
        ImageCopyResampled ( $img_des, $img_src, 0, 0, 0, 0, $this->GetThumbData('width'), $this->GetThumbData('height'), $this->GetImageData('width'), $this->GetImageData('height') );
		//ImageCopyResized( $img_des, $img_src, 0, 0, 0, 0, $this->GetThumbData('width'), $this->GetThumbData('height'), $this->GetImageData('width'), $this->GetImageData('height') );

		switch ( $this->GetImageData('type') ){
    	case 'gif':
    		if ( empty( $dest ) ){
    			header( "Content-type: image/gif" );
    			return ImageGIF( $img_des );
   			}else{
    			return ImageGIF( $img_des, $dest );
    		}
    		break;

    	case 'jpg':
    		if ( empty( $dest ) ){
    			header ( "Content-type: image/jpeg" );
    			return ImageJPEG( $img_des);
   			}else{
    			return ImageJPEG( $img_des, $dest,100);
    		}
    		break;

    	case 'png':
    		if ( empty( $dest ) ){
    			header ( "Content-type: image/png" );
    			return ImagePNG( $img_des );
   			}else{
    			return ImagePNG( $img_des, $dest );
    		}
    		break;
    	}// End switch
    }// End func
}// End class
?>
