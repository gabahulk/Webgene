<?php 
												////////////////////////////////////
												//WebGene:Genetic Assisted Design //
												////////////////////////////////////
	class Webgene{
		/**
		 * [this var will contain the type of the page(Home, form ,etc)]
		 * @var [string]
		 */
		private $type;
		/**
		 * This var will contain the mutation rate used on the algorithm
		 * @var [float]
		 */
		private $mutation_rate;
		private $lorem             = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam ratione debitis beatae, accusamus nisi modi repellendus quaerat tempora porro amet cumque dolores quod, reprehenderit? Deserunt voluptate eius inventore id quos";
		private $number_of_modules = 3;
		private $domtree = array();
		private $dom;
		/**
		 * possible column sizes
		 * @var array
		 */
		private $column_size = array(1 =>100 ,2 =>75 ,3 =>66, 4 =>50 ,5 =>33 ,6 =>25);
		public function __construct($type = 'home' , $mutation_rate ='1'){
			$this->type = $type;
			$this->mutation_rate = $mutation_rate;
		}
		/**
		 * This function will start a generation for the genetic algorithm
		 * @return [string] the DOM.
		 */
		public function start(){

			$current_size=0;
			$dom="<body>";
			$dom='<div class="container">';
			switch ($this->type) {
				case 'home':
					for ($i=0; $i <= mt_rand(3,6); $i++) {

						$dom_aux='<div class="divide-bottom">';
						$dom_aux.='<div class="grid-wrap">';
						$dom_aux.=$this->fill_coloumn();
						$dom_aux.='</div>';
						$dom_aux.='</div>';
						$domtree[]=$dom_aux;
						$dom.=$dom_aux;
					}
					break;
			}
			$dom.='</div>';
			$dom.="</body>";
			return($dom);
		}

		/**
		 * Creates a html module (which will be either an media div, text div, text+media div and empty div for now)
		 * @return [string] [return a module]
		 */
		public function create_module(){
			$code = "";
			switch (rand(1,$this->number_of_modules)) {
				case 1: //text module
					$code .=  "<h1>Title</h1><p>".$this->lorem."</p>"; 
					break;
				case 2:
					$code .=  "<div class='image'></div>"; //media module
					break;
				case 3:
					$code .=  "<div class='image'></div><h1>Title</h1><p>".$this->lorem."</p>"; //media+text module
					break;
				case 5:
					$code .=  "<div></div>"; //empty module
					break;
			}
			return($code);
		}
		public function fill_coloumn($module='',$current_size=0 ,$possible_sizes=0,$checksum=0){
			//check if it's the first time
			//
			if ($current_size == 0) {
				$current_size = $this->column_size[rand(1,5)];
			}
			if ($possible_sizes == 0) {
				$possible_sizes =  $this->column_size;
			}

			switch ($current_size) {
				case 100:
					$module .= '<div class="grid-col col-full">';
					$module.=$this->create_module();
					$module.='</div>';
					return($module);
					break;
				case 75:
					$module.= '<div class="grid-col col-three-quarters">';
					$module.=$this->create_module();
					$module.='</div>';
					foreach ($possible_sizes as $key => $value) { //removing impossible sizes
						if ( $value+$current_size != 99 && ($value+$current_size>100 || ($value+$current_size) % 5 !=0) )
						{
							unset($possible_sizes[$key]);
						}					
					}
					if (!empty($possible_sizes)) {
						$possible_sizes = array_values($possible_sizes); //reorganizing indexes
						$checksum += $current_size;
						if ($checksum>=99  && $checksum<=100) {
							return($module);
						}
						$current_size = $possible_sizes[rand(0,count($possible_sizes)-1)]; // gets a possible size for the next sibilling
						return($this->fill_coloumn($module,$current_size,$possible_sizes,$checksum));
					}
									
					break;
				case 66:
					$module .= '<div class="grid-col col-two-thirds">';
					$module.=$this->create_module();
					$module.='</div>';
					foreach ($possible_sizes as $key => $value) { //removing impossible sizes
						if ($value+$current_size != 99 && ($value+$current_size>100 || ($value+$current_size) % 5 !=0) )
						{
							unset($possible_sizes[$key]);
						}					
					}
					if (!empty($possible_sizes)) {
						$possible_sizes = array_values($possible_sizes); //reorganizing indexes
						$checksum += $current_size;
						if ($checksum>=99  && $checksum<=100) {
							return($module);
						}
						$current_size = $possible_sizes[rand(0,count($possible_sizes)-1)]; // gets a possible size for the next sibilling
						return($this->fill_coloumn($module,$current_size,$possible_sizes,$checksum));	
					}
					return($module);
					break;
				case 50:
					$module.='<div class="grid-col col-one-half">';
					$module.=$this->create_module();
					$module.='</div>';
					foreach ($possible_sizes as $key => $value) { //removing impossible sizes
						
						if ($value+$current_size != 99 && ($value+$current_size>100 || ($value+$current_size) % 5 !=0) )
						{
							unset($possible_sizes[$key]);
						}elseif ($value+$current_size==100) {
							$aux_key=$value;	
						}				
					}
					
					if (!empty($possible_sizes)) {
						$possible_sizes = array_values($possible_sizes); //reorganizing indexes
						$checksum += $current_size;
						if ($checksum>=99  && $checksum<=100) {
							return($module);
						}
						$current_size = $possible_sizes[rand(0,count($possible_sizes)-1)]; // gets a possible size for the next sibilling
						return($this->fill_coloumn($module,$current_size,$possible_sizes,$checksum));	
					}
					return($module);
					break;
				case 33:
					$module .= '<div class="grid-col col-one-third">';
					$module.=$this->create_module();
					$module.='</div>';
					foreach ($possible_sizes as $key => $value) { //removing impossible sizes
						
						if ($value+$current_size != 99 && ($value+$current_size>100 || ($value+$current_size) % 5 !=0) )
						{
							unset($possible_sizes[$key]);
													}					
					}
					if (!empty($possible_sizes)){
					$possible_sizes = array_values($possible_sizes); //reorganizing indexes
					$checksum += $current_size;
					if ($checksum>=99  && $checksum<=100) {
						return($module);
					}
					$current_size = $possible_sizes[rand(0,count($possible_sizes)-1)]; // gets a possible size for the next sibilling
					return($this->fill_coloumn($module,$current_size,$possible_sizes,$checksum));	
					}
					
					return($module);//if there's no possible size left return the module
					break;	
				case 25:
					$module .= '<div class="grid-col col-one-quarter">';
					$module.=$this->create_module();
					$module.='</div>';
					foreach ($possible_sizes as $key => $value) { //removing impossible sizes
						
						if ($value+$current_size != 99 && ($value+$current_size>100 || ($value+$current_size) % 5 !=0) ){
							unset($possible_sizes[$key]);
						}					
					}
					if (!empty($possible_sizes)) {
						$possible_sizes = array_values($possible_sizes); //reorganizing indexes
						$checksum += $current_size;
						if ($checksum>=99 && $checksum<=100) {
							return($module);
						}
						$current_size = $possible_sizes[rand(0,count($possible_sizes)-1)]; // gets a possible size for the next sibilling
						return($this->fill_coloumn($module,$current_size,$possible_sizes,$checksum));
					}
					return($module);
					break;
			
			}
		}

	}
?>
