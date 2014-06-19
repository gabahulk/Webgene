<?php 


	/**
	* this class will contai the nodes of the dom
	*/	
	class domCreatorNode
	{
		public $value; // value of the node
		public $sons = array(); // it's sons. comment something here...

		function __construct($tag)
		{
			$this->value = $tag;
		}
	}


		/**
	* this class creates a tree that will represent the html
	*/
	class domCreatorTree
	{
		/*these will be the first nodes of the tree*/
		public $html_tag;
		public $head_tag;
		public $body_tag;
		public $body_sons = array();
		
		function __construct($head_title) // aray containing head variables such as web page title
		{
			$this->html_tag = "<html>";

			$this->head_tag = 
			"<head>
				<title>$head_title</title>
				<link rel='stylesheet' type='text/css' href='../css/gen.css'>
				<script src='http://code.jquery.com/jquery-latest.min.js'	type='text/javascript'>
				</script>
			</head>";

		$this->body_tag = "<body>";
	}


	public function insert($item) //falta saber como vai funcionar para dicionar ou irmão ou filho... isso vem do AG
	{
		$node = new domCreatorNode($item);
        // insert the node somewhere in the tree starting at the root
		$this->insertNode($node, $this->root);	
	}

	protected function insertNode($node, &$subtree) 
	{
		if ($subtree === null) 
		{
            // insert node here if subtree is empty
			$subtree = $node;
		}
		else 
		{
			if ($node->value > $subtree->value) 
			{
                // keep trying to insert right
				$this->insertNode($node, $subtree->right);
			}
			else if ($node->value < $subtree->value) 
			{
                // keep trying to insert left
				$this->insertNode($node, $subtree->left);
			}
			else 
			{
                // reject duplicates
			}
		}
	}


}
?>