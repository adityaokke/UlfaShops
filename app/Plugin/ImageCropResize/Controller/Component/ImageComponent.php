<?php
class ImageComponent extends Component {

	public $helpers = array('Html');

/**
 * Constructor
 *
 * @param ComponentCollection $collection A ComponentCollection this component can use to lazy load its components
 * @param array $settings Array of configuration settings.
 */
	public function __construct(ComponentCollection $collection, $settings = array()) {
		parent::__construct($collection, $settings);

		$explode = explode(DS,realpath(__DIR__ . DS . '..' . DS . '..'));
		$pluginName = end($explode);

		App::uses('Image', $pluginName . '.Lib');
	}

/**
 * Automatically resizes and/or crops an image and returns formatted IMG tag or URL
 *
 * @param string $path Path to the image file
 * @param array $options
 *
 * @return mixed Image tag or URL of the resized/cropped image
 *
 * @access public
 */
	public function resize($source,$path, $desti,$options = array()) {
		$options = array_merge(array(
			'width'				=> null,	//Width of the new Image, Default is Original Width
			'height'			=> null,	//Height of the new Image, Default is Original Height
			'aspect'			=> true,	//Keep aspect ratio
			'crop'				=> false,	//Crop the Image
			'cropvars'			=> array(), //How to crop the image, array($startx, $starty, $endx, $endy);
			'autocrop'			=> false,	//Auto crop the image, calculate the crop according to the size and crop from the middle
			'htmlAttributes'	=> array(),	//Html attributes for the image tag
			'quality'			=> 90,		//Quality of the image
			'urlOnly'			=> true		//Return only the URL or return the Image tag
			
		), $options);

		foreach ($options as $key => $option) {
			${$key} = $option;
		}

		$relFile = Image::resize($source,$path,$desti, $options);

		//Return only the URL
		if ($options['urlOnly']) {
			return $relFile;
		}

		// $array = explode(DS, $relFile);			    	
		// $array1 = explode("/", $array[0]);
		// end($array1);
		// $array2 = explode("_", $array1[key($array1)]);
		// $array3 = explode("x", $array2[0]);
		// if(isset($array3[1]) && $array3[1]<$options['height']){
		// 	$selisihH=$options['height'] - $array3[1];
		// 	$padTop=$selisihH/2;
		// 	$padBot=$selisihH-$padTop;
		// 	if(isset($options['htmlAttributes']['style']))
		// 	$tamp=$options['htmlAttributes']['style'];
		// 	else
		// 		$tamp='';
		// 	$options['htmlAttributes']=array('style'=>$tamp.'padding-top:'.$padTop.'px;'.
		// 													'padding-bottom:'.$padBot.'px;margin:auto;display: block;');		
		// }
		// if ($options['control']==='product') {
		// 	return array('link'=>$relFile,'htmlattr'=>$options['htmlAttributes']);;
		// }
		// else if(!isset($options['control'])){
		// 	return $this->Html->image($relFile,$options['htmlAttributes']); //iki code sg asli :3
		// }
		//return $this->Html->image($relFile,$options['htmlAttributes']); //iki code sg asli :3
	}
}
